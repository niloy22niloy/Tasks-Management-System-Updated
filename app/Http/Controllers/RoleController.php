<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    function role(){
        $permissions_list = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('super_admin.Role.role',[
            'permissions_list'=>$permissions_list,
            'roles'=>$roles,
            'users'=>$users,
        ]);  
    }
    function permission_store(Request $request){
        $request->validate([
            'name'=>'required',
            
        ],
        [   'name'=>'Role Name Are Same Or Null!! Try Different',
            
        ]);
        Permission::create([
            'name' => $request->permission_name,
        ]);
        return back()->with('success',"Successfully Add Permission");

    }
    function permission_edit($id){
        $permission_edit = Permission::find($id);
        return view('super_admin.Role.permission_edit',[
              'permission_edit'=>$permission_edit,
        ]);
    }
    function permission_edit_confirm(Request $request,$id){
        Permission::where('id',$id)->update([
            'name'=>$request->permission_name,
        ]);
        return redirect('/role')->with('success',"Permission Edit Successfully");
        
    }
    function permission_delete($id){
        Permission::find($id)->delete();
        return back()->with('success',"Successfully Deleted A Permission");
    }
    function role_store(Request $request){
        $request->validate([
            'role_name'=>'required',
            
        ],
        [   'role_name'=>'Something Is Wrong Either Same Or Null Data is Giving',
            
        ]);
       
        $role = Role::create([
            'name' => $request->role_name,
        ]);
        $role->givePermissionTo($request->permission_name);
        return back()->with('success',"Successfully Role Added");
    }
    function assign_role(Request $request){
        $request->validate([
            'user_id'=>'required',
            
        ],
        [   'user_id'=>'Something Is Wrong Either Same Or Null Data is Giving',
            
        ]);

        
         $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back()->with('success','Role Added Successfully to '. $user->name);

    }
    function assign_role_tologer(Request $request){
        
        $user = User::find(Auth::user()->id);
        $user->assignRole($request->role_id);
        $user->assignRole($request->role_id);
        return back()->with('success','Successfully Added Role');

    }
    function member_list(){
        $sss =  User::where('id','!=',Auth::user()->id)->role('Member')->get();
        $permissions_list = Permission::all();
        $roles = Role::all();
        $users = User::where('id','!=',Auth::user()->id)->get();
         $asd = Role::whereNotIn('name', ['Super_Admin '])->get();
         $all_users_with_all_their_roles = User::where('id','!=',Auth::user()->id)->with('roles')->get();
        return view('super_admin.members',[
            'users'=>$users,
            'roles'=>$roles,
            'all_users_with_all_their_roles'=>$all_users_with_all_their_roles,
            'sss'=>$sss,
        ]);
    }
    function remove_role($id){
       $user =  User::find($id);
       $user->syncRoles([]);
       $user->syncPermissions([]);
       
       return back()->with('success',$user->name."'s".' role removed Successfully');
       
    }
    function edit_user_role_permission($id){

        $user = User::find($id);
        
        $permissions_list = Permission::all();
        return view('super_admin.Role.edit_user_role_permission',[
            'user'=>$user,
            'permissions_list'=>$permissions_list,
        ]);
    }
    function permission_update(Request $request){
        $user = User::find($request->user_id);
         $permissions = $request->permission_name;
        $user->syncPermissions($permissions);
        return back();
    }
    function role_delete($id){
         Role::find($id)->delete();
        return back()->with('success','Role Deleted Successfully');
       
    }
}
