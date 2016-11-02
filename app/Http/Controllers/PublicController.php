<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;
use App\FeedSources;
use App\FeedsItems;

use Input;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $feedItems = FeedsItems::orderBy('created_at' , 'DESC')->paginate(20);

        $fields = array('title' , 'created_at');

        //@todo @fix - this just isn't right :(
        $categories = Categories::all();

        return view('welcome' , compact('feedItems' , 'fields' , 'categories'));
    }


    public function filter(Request $request){

        if(!$request->ajax()){
            return redirect()->back();
        }

        $return = array('status' => 0);

        $fields = array('title' , 'created_at');

        $feedSearch = FeedSources::where('category_id' , Input::get('category_id'));

        if ($feedSearch->count() > 0){

            $return['status'] = 1;

            $sourceList = array();

            //gather field list
            foreach ($feedSearch->get() as $feedSources) {
                $sourceList[] = $feedSources->id;
            }

            $return['source_list'] = $sourceList;

            $feedItems = FeedsItems::whereIn('source_id' , $sourceList)->take(50)->get();

            $return['items'] = $feedItems;

            $return['html'] = view('parts.public_list_builder' , array('list' => $feedItems , 'fields' => $fields ))->render();
        }else{

            $return['status'] = 2;

            $feedItems = FeedsItems::orderBy('created_at' , 'DESC')->paginate(20);

            $return['html'] = view('parts.public_list_builder' , array('list' => $feedItems , 'fields' => $fields ))->render();           
        }

        return response()->json($return);
    }

    public function feedData(Request $request , $id){

        if(!$request->ajax()){
            return redirect()->back();
        }

        $feedItems = FeedsItems::where('id' , $id);  

        $return = '';  

        if ($feedItems->count() > 0){
            $feedItem = $feedItems->first();

            $return = view('parts.feed_modal' , compact('feedItem'));
        } 

        return $return;        
    }
}
