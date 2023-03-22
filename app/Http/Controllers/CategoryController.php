<?php

namespace App\Http\Controllers;

use App\Models\CategoryBasedProject;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category_insert(){
        
        $categories = CategoryModel::all();
        return view('super_admin.category_insert',[
            'categories'=>$categories,
        ]);
    }
    function category_submit(Request $request){
        // $request->validate([
        //     'category_name' => "required|unique:category_models,category_name",
            
        // ]);
        $request->validate([
            'category_name'=>'required',
            
        ],
        [   'category_name'=>'ভাই ক্যাটাগরি দেন',
            
        ]);

        
        CategoryModel::create([
            'category_name'=>$request->category_name,
            'added_by'=>$request->added_by,
        ]);
        return back()->with('success','Category Added Successfully');
    }
    function category_show(){
       
        $categories = CategoryModel::where('added_by',Auth::user()->id)->get();
       
        
        return view('super_admin.category_show',[
            'categories'=>$categories,
        ]);
    }
    function category_delete($id){
       
        CategoryModel::find($id)->delete();
        CategoryBasedProject::where('category_id',$id)->delete();
        return back()->with('success','Category Deleted Successfully');
    }
    function category_edit($id){
        $category_edit = CategoryModel::find($id);
        return view('super_admin.Category.category_edit',[
            'category_edit'=>$category_edit,
        ]);
    }
    function category_edit_confirm(Request $request,$id){
        
        CategoryModel::where('id',$id)->update([
            'category_name'=>$request->category_name,
        ]);
        return back()->with('success','Category Name Updated Successfully');
    }
}
