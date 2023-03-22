<?php

namespace App\Http\Controllers;

use App\Models\CategoryBasedProject;
use App\Models\CategoryModel;
use App\Models\RequestForTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    function project_add_page(){
        $categories = CategoryModel::where('added_by',Auth::user()->id)->get();
        return view('super_admin.Project.project_add_page',[
            'categories'=>$categories,
        ]);
    }
    function categorywise_project_insert(Request $request){
       
        
            // $request->validate([
            //     'project_name' => 'required',
            // ]);


            $request->validate([
                'category_id'=>'required',
                'project_name' => 'required',
                'priority'=>'required',
                'deadline'=>'required',
                'status'=>'required',
            ],
            [   'category_id'=>'ভাই ক্যাটাগরি দেন',
                'project_name' => 'ভাই নাম দেন !',
                'priority'=>'ভাই প্রায়োরিটি দেন',
                'deadline'=>'ভাই ডেডলাইন দেন',
                'status'=>'ভাই স্টেটাস দেন',
            ]);



            

        CategoryBasedProject::create([
        'category_id'=>$request->category_id,
        'project_name'=>$request->project_name,
        'added_by'=>$request->added_by,
        'priority'=>$request->priority,
        'deadline'=>$request->deadline,
        'status'=>$request->status,
        ]);
        return back()->with('success','Project Added Successfully');
    }
    function project_list(){
        $projects = CategoryBasedProject::where('added_by',Auth::user()->id)->orderBy("priority", "asc")->orderBy("created_at", "desc")->get();
        
        return view('super_admin.Project.project_list',[
            'projects'=>$projects,
        ]);
    }
    function project_edit_page($id){
        $categories = CategoryModel::where('added_by',Auth::user()->id)->get();
        $projects = CategoryBasedProject::find($id);
        return view('super_admin.Project.project_edit_page',[
            'projects'=>$projects,
            'categories'=>$categories,
        ]);
    }
    function project_update(Request $request,$id){
        // return $request->category_id;
         CategoryBasedProject::where('id',$id)->update([
             'category_id'=>$request->category_id,
             'project_name'=>$request->project_name,
             'priority'=>$request->priority,
             'deadline'=>$request->deadline,
             'status'=>$request->status,
        ]);
        return back()->with('success','Project Updated Successfully');
    }

    function project_delete($id){
        RequestForTask::where('category_based_project_id',$id)->delete();
        CategoryBasedProject::find($id)->delete();
        return back()->with('success','Project Deleted Successfully');
    }
}
