<?php

namespace App\Http\Controllers;

use App\Models\GuestWorkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class WorkController extends Controller
{
    //
    function work_add_page(Request $request){
        return view('guest.Work.work_add_page');
    }
    function work_upload_success(Request $request){
    //     $this->validate($request, [
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:855',
    //   ]);
      
    $input=$request->all();
    
    $images=array();
    if($files=$request->file('images')){
        foreach($files as $file){
            $name=$file->getClientOriginalName();
            $file->move('image',$name);
            $images[]=$name;
            
        }
        
    }
    /*Insert your data*/

    GuestWorkModel::create( [
        'Work_Name'=>$request->work_name,
        'Work_Description'=>$request->work_description,

        'Work_Images'=>  implode("|",$images),
        'Created_By'=>Auth::guard('guestlogin')->user()->id,
        
        //you can put other insertion here
    ]);
    return back()->with('success','Work Added Successfully');
    }
    function work_list(){
        $work_list =  GuestWorkModel::where('Created_By',Auth::guard('guestlogin')->user()->id)->get();
        return view('guest.Work.work_list',[
            'work_list'=>$work_list,
        ]);
    }
    function work_details($id){
        $work_details =GuestWorkModel::find($id);
        
        return view('guest.Work.work_show',[
            'work_details'=>$work_details,
            
        ]);
    }
}
