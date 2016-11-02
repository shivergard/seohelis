<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Redirect;
use Input;
use Validator;

class FeedCategoryController extends Controller
{

    private $rules = array(
        'name' => 'required|max:50',
        'description' => 'max:250',
    );

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Feed list
     *
     * @return \Illuminate\Http\Response
     */
    public function list(){

        $list = Categories::paginate(10);

        $fields = array('id' , 'name' , 'description' , 'created_at');

        return view('category.list' , compact('list' , 'fields'));
    }

    public function add(){

        $controller = 'FeedCategoryController';

        $fields = array('name' , 'description');

        return view('category.add' , compact('controller' , 'fields'));
    }

    public function edit($id){

        $categorySearch = Categories::where('id' , $id);

        if ($categorySearch->count() == 0){
            return Redirect::back()->withErrors(array('delete' => 'Missing ID'));
        }

        $category = $categorySearch->first();

        $fields = array('name' , 'description');

        $controller = 'FeedCategoryController';

        return view('category.edit' , compact('category' , 'fields' , 'controller'));
    }


    public function view($id){

        $categorySearch = Categories::where('id' , $id);

        if ($categorySearch->count() == 0){
            return Redirect::back()->withErrors(array('delete' => 'Missing ID'));
        }

        $category = $categorySearch->first();

        $controller = 'FeedCategoryController';

        $fields = array('id' , 'name' , 'description');

        return view('category.show' , compact('category' , 'controller' , 'fields'));
    }

    public function store(){
        $return = Redirect::back();

        $validator = Validator::make(Input::all(), $this->rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            if (Input::has('id')){
                $categorySearch = Categories::where('id' , Input::get('id')); 
                
                if ($categorySearch->count() == 1){
                    $category = $categorySearch->first();
                }else{
                    //@todo - guess some error output
                    return Redirect::back();
                }   
            }else{
                $category = new Categories();
            }

            foreach ($category->getFillable() as $key => $field_name) {
                $category->$field_name = Input::get($field_name);
            }

            if ($category->save()){
                $return = Redirect::to(action("FeedCategoryController@list"));
            } 
        }

        return $return;
    }

    public function delete(){

        $return = Redirect::to(action("FeedCategoryController@list"));
        
        $items = Categories::where('id' , intval($id))->count();

        if (!($items->count() == 1 && $items->delete())){
            $return->withErrors(array('delete' => 'Missing ID'));  
        }

        return $return;

    }
}
