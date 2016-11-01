<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;

class ProfileController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $errors = array();

        $rules = array('email' => 'required|email');

        if (isset($input['pswd']) && trim($input['pswd']) != ''){
            //is password the same
            if (trim($input['pswd']) != trim($input['pswd2'])){
                $errors['pswd'] = 'Password missmatch';
            }else{
                $rules['pswd'] = 'required|min:8';
            }            
        }

        $validator = Validator::make($input, $rules);

        if ($validator->fails()){
            $errors = array_merge($errors , $validator->messages()->getMessages());
        }

        $return = Redirect::back();

        if (count($errors) > 0){
            $return->withErrors($errors);
        }else{
            Auth::user()->email = $input['email'];

            if (isset($input['pswd']) && trim($input['pswd']) != ''){
                Auth::user()->password = bcrypt($input['pswd']);
            }

            Auth::user()->save();
        }

        return $return;
    }
}
