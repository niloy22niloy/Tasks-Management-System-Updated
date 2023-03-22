<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    //
    function guest_login_req(Request $request){
       
        if(Auth::guard('guestlogin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            
        ])){
            return redirect('/guest/login/dashboard');
        }else{
            return redirect('/guest/login') ;
        }
        
        
        
    }

    }

