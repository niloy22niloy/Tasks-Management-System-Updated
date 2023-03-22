<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestPassReset;
use App\Notifications\GuestPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
class GuestController extends Controller
{
    function guest_register(){
        return view('guest.guest_register');
    }
    function guest_login(){
        return view('guest.guiest_login');
    }
    function guest_store(Request $request){
        GuestLogin::create([
             'name'=>$request->username,
             'email'=>$request->email,
             'password'=>bcrypt($request->password),
        ]);
        return redirect('/guest/login');
    }
    function dashboard(){
        return view('guest.dashboard.home_dashboard');
    }
    function guest_logout(){
        Auth::guard('guestlogin')->logout();
        return redirect('/guest/login');
    }
    function guest_pass_reset_req(){
        return view('guest.pass_reset_form');
    }
    function guest_pass_req_send(Request $request){
        $guest_info = GuestLogin::where('email',$request->email)->firstOrFail();
        GuestPassReset::where('guest_id',$guest_info->id)->delete();
        $guest_inserted = GuestPassReset::create([
           'guest_id'=>$guest_info->id,
           'token'=>uniqid(),
           
        ]);
        Notification::send($guest_info, new GuestPassResetNotification($guest_inserted));
        return back()->with('success','Verification Message Send In Your Email');
    }
    function guest_pass_reset_form($token){
        return view('guest.update_pass_form',[
            'token'=>$token,
        ]);
    }
    function pass_reset(Request $request){
       
        $guest_info = GuestPassReset::where('token',$request->token)->firstOrFail();
        GuestLogin::findOrFail($guest_info->guest_id)->update([
            'password'=>bcrypt($request->new_password),
        ]);
        $guest_info->delete();
        return redirect('/guest/login')->with('success','password updated Successfully');
    }
    
}
