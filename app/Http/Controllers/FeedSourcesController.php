<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedSources;
use App\Categories;
use Redirect;
use Input;
use Validator;

class FeedSourcesController extends Controller
{

    private $rules = array(
        'title' => 'required|max:50',
        'description' => 'max:250',
        'url' => 'required|active_url',
        'category_id' => 'required|integer'
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

        $list = FeedSources::paginate(10);

        $fields = array('id' , 'title' , 'description' , 'url' , 'created_at');

        return view('feed.list' , compact('list' , 'fields'));
    }

    public function add(){

        $controller = 'FeedSourcesController';

        $fields = array('title' , 'description' , 'url');

        //@todo @fix - this just isn't right :(
        $categories = Categories::all();

        return view('feed.add' , compact('controller' , 'fields' , 'categories'));
    }

    public function edit($id){

        $feedSourceSearch = FeedSources::where('id' , $id);

        if ($feedSourceSearch->count() == 0){
            return Redirect::back()->withErrors(array('delete' => 'Missing ID'));
        }

        $feedSource = $feedSourceSearch->first();

        $fields = array('title' , 'description' , 'url');

        //@todo @fix - this just isn't right :(
        $categories = Categories::all();

        $controller = 'FeedSourcesController';

        return view('feed.edit' , compact('feedSource' , 'fields' , 'controller' , 'categories'));
    }


    public function view($id){

        $feedSourceSearch = FeedSources::where('id' , $id);

        if ($feedSourceSearch->count() == 0){
            return Redirect::back()->withErrors(array('delete' => 'Missing ID'));
        }

        $feedSource = $feedSourceSearch->first();

        $controller = 'FeedSourcesController';

        $fields = array('id' , 'name' , 'description' , 'url');

        return view('feed.show' , compact('feedSource' , 'controller' , 'fields'));
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
                $feedSourceSearch = FeedSources::where('id' , Input::get('id')); 
                
                if ($feedSourceSearch->count() == 1){
                    $feedSource = $feedSourceSearch->first();
                }else{
                    //@todo - guess some error output
                    return Redirect::back();
                }   
            }else{
                $feedSource = new FeedSources();
            }

            foreach ($feedSource->getFillable() as $key => $field_name) {
                $feedSource->$field_name = Input::get($field_name);
            }

            if ($feedSource->save()){
                $return = Redirect::to(action("FeedSourcesController@list"));
            } 
        }

        return $return;
    }

    public function delete(){

        $return = Redirect::to(action("FeedSourcesController@list"));
        
        $items = Categories::where('id' , intval($id))->count();

        if (!($items->count() == 1 && $items->delete())){
            $return->withErrors(array('delete' => 'Missing ID'));  
        }

        return $return;

    }
}
