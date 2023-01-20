<?php

namespace App\Http\Controllers;
use Auth; 
Use validator;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function checklogin(Request $request)
    {
        //validation
        $this->validate($request,[
            'email' =>'required|email', 
            'password' => 'required|alphaNum|min:4'
        ]);
        //Authentication
        $user_data = array(
            'email' =>$request->get('email'),
            'password' =>$request->get('password'),
        );
        
    }
    function logout()
    {
        auth::logout();
        return redirect()->route('start');
    }
}

