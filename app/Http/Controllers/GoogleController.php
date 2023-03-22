<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    //
    function redirect_provider(){
        return Socialite::driver('google')->redirect();
    }
    function provider_to_application(){
        $user = Socialite::driver('google')->user();
            print_r($user->getEmail());
        if(User::where('email',$user->getEmail())->exists()){
            if(Auth::user()->attempt(['email'=>$user->getEmail(),'passowrd'=>'abc@123'])){
                return redirect()->route('home');
            }
        }
        else{
            User::create([
              'name'=>$user->getName(),
              'email'=>$user->getEmail(),
              'password'=>bcrypt('abc@123'),

            ]);
            if(Auth::user()->attempt(['email'=>$user->getEmail(),'password'=>'abc@123'])){
                return redirect()->route('home');
            }
        }
    }
}
