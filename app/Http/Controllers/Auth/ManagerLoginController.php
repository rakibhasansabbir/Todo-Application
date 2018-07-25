<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ManagerLoginController extends Controller
{
    public function __construct(){

        $this->middleware('guest:manager');
    }

    public function showLoginForm(){
        return view('auth.manager-login');
    }

    public function login(Request $request){

        //form validate
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6',
        ]);

       if ( Auth::guard('manager')->attempt(['email' => $request->email,
           'password' => $request->password], $request->remember)){

           return redirect()->intended(route('manager.dashboard'));
       }

       return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
