<?php

namespace App\Http\Controllers;

use App\Models\CategoryBasedProject;
use App\Models\RequestForTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\DemoMail;

use App\Mail\ReceivedMail;

class TaskFindController extends Controller
{
    //
    function task_list_from_user(){
        $tasks_all = CategoryBasedProject::all();
        return view('guest.task_list.task_list',[
            'tasks_all'=>$tasks_all,
        ]);
    }
    function req_task($id){
        //request to
        $all =  CategoryBasedProject::find($id);
        
        $all->added_by;
        $request_to_details =  User::find($all->added_by);
        ////////////////////////////
        
        //request by//
       

         $request_by = Auth::guard('guestlogin')->user()->email;
         if (RequestForTask::where('request_by', '=', $request_by)->where('request_to','=',$request_to_details->email)->where('category_based_project_id','=',$id)->exists()) {
            return back()->with('fail','Already Send Request For These Project');
         }else{
            $asd = CategoryBasedProject::find($id);
            RequestForTask::create([
                'category_based_project_id'=>$id,
                'request_to'=>$request_to_details->email,
                'request_by'=>$request_by,
                'status'=>0,
            ]);
            $mailData = [
                
                'title' => 'Mail from Task Management',
                'body' => 'your request For Task to.<a>'.$request_to_details->email.'</a>has been send',
            ];
            
             
            Mail::to($request_by)->send(new DemoMail($mailData));
           
            $mailData = [
                
                'title' => 'Mail from Task Management',
                'body' => 'A Request From This .<a>'.$request_by.'</a>has been Come For doing the Task',
            ];
           
            Mail::to($request_to_details->email)->send(new DemoMail($mailData));
            return back()->with('success','Successfully Send The Request For This Task');
         }

        
        
    }
    function task_req_show(){
         $task_req_list =  RequestForTask::where('request_by',Auth::guard('guestlogin')->user()->email)->get();
        foreach($task_req_list as $task){
             ($task->category_based_project_id);
             $asd = CategoryBasedProject::find($task->category_based_project_id);
               $asd->project_name;
              $a= $asd->deadline;
              $now = now()->format('Y-m-d');
             $start =  now()->format('Y-m-d');
             $end = $asd->deadline;
             $diff = strtotime($end) - strtotime($start);
              $s =  (round($diff / 86400));
              if($s<0){
                $z = RequestForTask::find($task->id);
                if($z->checking == Null){
                    RequestForTask::where('id',$z->id)->update([
                     'checking'=>1,
                    ]);
                    $mailData = [
                
                    'title' => 'Mail from Task Management',
                    'body' => 'Your Deadline Is Over for ' . $asd->project_name .' Project!!Please Contact With The Task Manager',
                ];
               
                Mail::to($task->request_by)->send(new DemoMail($mailData));
                }
                // $mailData = [
                
                //     'title' => 'Mail from Task Management',
                //     'body' => 'A Request From This is'.$s.' now working for this Task',
                // ];
               
                // Mail::to($task->request_by)->send(new DemoMail($mailData));
                
                // return redirect('/task/req/show');
              }
            
        }
         
        return view('guest.task_list.task_req_list',[
            'task_req_list'=>$task_req_list,
            
        ]);

    }
    function work($id){
        $asd = RequestForTask::find($id);
         $asd->request_to;
         $asd->request_by;
         RequestForTask::where('id',$id)->update([
           'compelete'=>2,
        ]);
        $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => 'A Request From This .<a>'.$asd->request_by.'</a>is now working for this Task',
        ];
       
        Mail::to($asd->request_to)->send(new DemoMail($mailData));
        
        return redirect()->back()->with('success','Progress Added Successfully');
    }
    function work_done($id){
        $asd = RequestForTask::find($id);
         $asd->request_to;
         $asd->request_by;
        RequestForTask::where('id',$id)->update([
            'compelete'=>1,
         ]);
         $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => 'A Request From This .<a>'.$asd->request_by.'</a>has finished your Task',
        ];
       
        Mail::to($asd->request_to)->send(new DemoMail($mailData));
         return back()->with('success',"Progress Added Successfully");
    }
    function work_delete($id){
        
        $dds = RequestForTask::find($id);
         $dds->request_to;
         $dds->request_by;
         $asd = RequestForTask::find($id)->delete();
         $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => 'A Request From This .<a>'.$dds->request_by.'</a>has Deleted The Task',
        ];
       
        Mail::to($dds->request_to)->send(new DemoMail($mailData));
        return back()->with('success',"Progress Added Successfully");

    }

}
