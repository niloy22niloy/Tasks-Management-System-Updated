<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Illuminate\Http\Request;

class AdminWithMember extends Controller
{
    //
   function hire_member(){
    $member_list = GuestLogin::all();
    return view('super_admin.member_list',[
        'member_list'=>$member_list,
    ]);
   }
   function member_details($id){
    $members_details = GuestLogin::find($id);
    return view('super_admin.member_details',[
        'members_details'=>$members_details,
    ]);
   }
}
