<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\RequestForTask;
use App\Models\User;
use Illuminate\Http\Request;
use Notification;
use Mail;
use App\Mail\DemoMail;


class TaskRequestsfromMember extends Controller
{
    //
    function show_request_list($id){
        $user_info = User::find($id);
         $user_info->email;
         $requests =  RequestForTask::where('request_to',$user_info->email)->get();
         
         return view('super_admin.task_requests_show',[
            'requests'=>$requests,
         ]);
    }
    function accept_tasks($id){
        $mail = RequestForTask::find($id);
         $mail->request_by;
         $mail->request_to;
        RequestForTask::where('id',$id)->update([
            'status'=>1,
        ]);
        $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => 'Your Request Has Been Accepted By .<a>'.$mail->request_to.'</a> For The Task',
        ];
        
        Mail::to($mail->request_by)->send(new DemoMail($mailData));
        return back()->with('success','Accepted Successfully');
    }
    function requester_description($id){
        $requestter_find =  RequestForTask::find($id);
        $requester = GuestLogin::where('email',$requestter_find->request_by)->get();
        return view('super_admin.requester_description',[
            'requester'=>$requester,
        ]);
    }
    function request_delete($id){
        $a = RequestForTask::find($id);
        $b= $a->request_by;
        $mailData = [
                
            'title' => 'Mail from Task Management',
            'body' => 'Your Request Has Been Rejected',
        ];
        
        Mail::to($a->request_by)->send(new DemoMail($mailData));
        
        RequestForTask::find($id)->delete();
        return back()->with('success','Request Has Been Deleted');

      
      
    }
    function profile($id){
         $asd = User::find($id);
         return view('profile',[
            'asd'=>$asd,
         ]);
    }
}
