<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    
    {
        $roles = Role::where('name','!=','Super_Admin')->get();
        return view('home',[
            'roles'=>$roles,
        ]);
    }
    function update_profile(Request $request,$id){
        
        
        if($request->password){
            $request->validate([
                'password' => ['min:8'],
            ]);
            if($request->image){
                $imageName = $request->name.'.'.$request->image->extension();
            
                // Public Folder
                $request->image->move(public_path('guest_image'), $imageName);
                User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'image'=>$imageName,
                    'Designation'=>$request->designation,
                    'About'=>$request->About,
                    
                ]);
                return back()->with('success',"successfully Updated");
            }else{
                User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    
                    'Designation'=>$request->designation,
                    'About'=>$request->About,
                    
                ]);
                return back()->with('success',"successfully Updated");
            }
            
        }else{
            if($request->image){
                $imageName = $request->name.'.'.$request->image->extension();
            
                // Public Folder
                $request->image->move(public_path('guest_image'), $imageName);
                User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'image'=>$imageName,
                    'Designation'=>$request->designation,
                    'About'=>$request->About,
                    
                ]);
                return back()->with('success',"successfully Updated");
            }else{
                User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    
                    'Designation'=>$request->designation,
                    'About'=>$request->About,
                    
                ]);
                return back()->with('success',"successfully Updated");
            }
            
        }
       
    }
    function user_profile($id){
       $users = User::find($id);
        return view('member_page',[
            'user'=>$users,
        ]);
    }
}
