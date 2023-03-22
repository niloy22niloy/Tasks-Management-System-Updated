<?php

namespace App\Http\Controllers;

use App\Models\CategoryBasedProject;
use App\Models\RequestForTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\DB;

class AssiginingNewTask extends Controller
{
    //
    function assigning_newtask($id){
        $user = User::find($id);
        $projects = CategoryBasedProject::where('added_by',Auth::user()->id)->orderBy("priority", "asc")->orderBy("created_at", "desc")->get();
        return view('super_admin.assigining_task',[
            'projects'=>$projects,
            'user'=>$user,
        ]);
    }
    function assign_task($id,$category_id){
        
        //  $category_id;
        // return $ca= CategoryBasedProject::where('id',$category_id)->get();
        $member_info = User::find($id);
        $record = RequestForTask::where('request_by', '=', Auth::user()->email)->where('request_to','=',$member_info->email)->where('category_based_project_id','=',$category_id);






        if (RequestForTask::where('request_by', '=', Auth::user()->email)->where('request_to','=',$member_info->email)->where('category_based_project_id','=',$category_id)->exists()) {
            return back()->with('fail','You Already Assign The Task To This Person');
         }   
         else{
             $ca= CategoryBasedProject::where('id',$category_id)->get();
         
            foreach($ca as $c){
               $c->status;
             $c->project_name;
            }
           $status =$c->status;
           $project_name = $c->project_name;
   
           $member_info = User::find($id);
           RequestForTask::create([
                    'category_based_project_id'=>$category_id,
                    'request_to'=>$member_info->email,
                    'request_by'=>Auth::user()->email,
                    'status'=>$c->status,
                    'exist'=>1
                   
             
           ]);
           $mailData = [
                   
               'title' => 'Mail from Task Management',
               'body' => 'This '.$project_name.'has been given you From '.Auth::user()->email,
           ];
          
           Mail::to($member_info->email)->send(new DemoMail($mailData));
           $mailData = [
                   
               'title' => 'Mail from Task Management',
               'body' => 'You Have Assigned This '.$project_name.'To  '.$member_info->email,
           ];
          
           Mail::to(Auth::user()->email)->send(new DemoMail($mailData));
           return back()->with('success','Successfully Send The Task');
         }     
   
   
         
        
    }
    function remove_task($id,$category_id){
        $member_info = User::find($id);
        $record = RequestForTask::where('request_by', '=', Auth::user()->email)->where('request_to','=',$member_info->email)->where('category_based_project_id','=',$category_id);
        if($record->exists()){
            $record->delete();
            
            $mailData = [
                   
                'title' => 'Mail from Task Management',
                'body' => 'You Have Cancel The Task which given to '.$member_info->email,
            ];
           
            Mail::to(Auth::user()->email)->send(new DemoMail($mailData));
            $mailData = [
                   
                'title' => 'Mail from Task Management',
                'body' => Auth::user()->email.' Have Cancel The Task which was given to you',
            ];
           
            Mail::to($member_info->email)->send(new DemoMail($mailData));
            return back()->with('success','Successfully Deleted The Task');
        }else{
            return back()->with('fail','You Have Not Assigning The Task Yet');
        }
        
        
    }
        
    
    function my_tasklist($id){
        
      $task_req_list =  RequestForTask::where('request_to',Auth::user()->email)->get();
      foreach($task_req_list as $task){
         $task->category_based_project_id;
          $task->id;
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
                   
                    Mail::to($task->request_to)->send(new DemoMail($mailData));
         }
      }
      elseif($s == 0){
        $z = RequestForTask::find($task->id);
        if($z->checking == Null){
            RequestForTask::where('id',$z->id)->update([
             'checking'=>1,
            ]);
            $mailData = [
        
                'title' => 'Mail from Task Management',
                'body' => 'Your Have Only Today To Comeplete ' . $asd->project_name .' Project!!Please Contact With The Task Manager',
            ];
           
            Mail::to($task->request_to)->send(new DemoMail($mailData));
 }
      }
      elseif($s == 1){
        $z = RequestForTask::find($task->id);
        if($z->checking == Null){
            RequestForTask::where('id',$z->id)->update([
             'checking'=>1,
            ]);
            $mailData = [
        
                'title' => 'Mail from Task Management',
                'body' => 'Your Have Only One Day Left To Complete This ' . $asd->project_name .' Project!!Please Contact With The Task Manager',
            ];
           
            Mail::to($task->request_to)->send(new DemoMail($mailData));
 }
      }
    }
          $user_info = User::find($id);
          $user = RequestForTask::where('request_to',$user_info->email)->get();
          
        return view('super_admin.my_own_task_list',[
            'user_info'=>$user_info,
            'user'=>$user,
        ]);
    }
    function working_onit($id){
         $work = RequestForTask::find($id);
          $category = $work->category_based_project_id;
           $project = CategoryBasedProject::find($category);
            $project->project_name;
        if (RequestForTask::where('id', '=', $id)->where('compelete','=',2)->exists()) {
            return back()->with('fail','You Cannot Send The Same Progress On It');
         }
         RequestForTask::where('id',$id)->update([
            'compelete'=>2
         ]);
         $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => $work->request_to.' Has started Working On '.$project->project_name.'Project',
        ];
       
        Mail::to($work->request_by)->send(new DemoMail($mailData));
        return back()->with('success','Add Progression');
        
    }
    function working_done($id){
        $work = RequestForTask::find($id);
          $category = $work->category_based_project_id;
           $project = CategoryBasedProject::find($category);
            $project->project_name;
        if (RequestForTask::where('id', '=', $id)->where('compelete','=',1)->exists()) {
            return back()->with('fail','You Cannot Send The Same Progress On It');
         }
        RequestForTask::where('id',$id)->update([
            'compelete'=>1
         ]);
         $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => $work->request_to.' Has Finished Work On '.$project->project_name.'Project',
        ];
       
        Mail::to($work->request_by)->send(new DemoMail($mailData));
         return back()->with('success','Add Progression');
    }
    function my_memberlist($id){
         $user_info = User::find(Auth::user()->id);
          $my_memberlist = RequestForTask::where('request_by',Auth::user()->email)->get();

        return view('super_admin.my_task_member_list',[
            'user_info'=>$user_info,
            'my_memberlist'=>$my_memberlist,
        ]);
    }
    function delete_mytaskmembers($id){
        $sd = RequestForTask::find($id);
        $delete = RequestForTask::find($id)->delete();
        $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => $sd->request_by.' Has cancel the task',
        ];
       
        Mail::to($sd->request_to)->send(new DemoMail($mailData));
        
        return back()->with('success','Task Member Deleted Successfully');
    }
}