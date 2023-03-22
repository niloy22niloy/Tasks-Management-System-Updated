<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Illuminate\Http\Request;

class GuestProfile extends Controller
{
    //
    function profile_page($id){
        
         $asd = GuestLogin::find($id);
         return view('guest.dashboard.guest_edit_page',[
            'asd'=>$asd,
         ]);
    }
    function guest_update(Request $request,$id){
        
        
        
        if($request->password){
            if($request->image){
                $imageName = $request->name.'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('guest_image'), $imageName);
                
                GuestLogin::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'designation'=>$request->designation,
                    'password'=>bcrypt($request->password),
                    'photo'=>$imageName,
                    'description'=>$request->work_description,
    
                    
               ]);
               return back()->with('success',"Successfully Updated");
            }else{
                GuestLogin::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'designation'=>$request->designation,
                    'password'=>bcrypt($request->password),
                    
                    'description'=>$request->work_description,
    
                    
               ]);
               return back();
            }
            
        }else{
            if($request->image){
                $imageName = $request->name.'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('guest_image'), $imageName);
                
                GuestLogin::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'designation'=>$request->designation,
                    
                    'photo'=>$imageName,
                    'description'=>$request->work_description,
    
                    
               ]);
               return back()->with('success',"Successfully Updated");
        }else{
            GuestLogin::where('id',$id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'designation'=>$request->designation,
                'description'=>$request->work_description,

                
           ]);
           return back()->with('success',"Successfully Updated");
        }
       
    }

}
function profile_show($id){

       $guest = GuestLogin::find($id);
       return view('guest.dashboard.guest_profile_page',[
           'guest'=>$guest,
       ]);

}
}
