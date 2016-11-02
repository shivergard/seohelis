<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;
use App\FeedSources;
use App\FeedsItems;

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

        return view('welcome' , compact('feedItems' , 'fields'));
    }
}
