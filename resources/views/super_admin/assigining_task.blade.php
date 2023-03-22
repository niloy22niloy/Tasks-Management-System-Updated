@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Assign A Task To ({{$user->name}})</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <tr>
                            <th>Serial</th>
                            <th>Project Name</th>
                            <th>Project Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Condition</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($projects as $key=>$projects)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$projects->project_name}}</td>
                        <td>
                            @php
                                $category = App\Models\CategoryModel::find($projects->category_id);
                                echo $category->category_name;
                            @endphp
                        </td>
                        <td>
                            @if($projects->priority == 1)
                                <span class="badge badge-primary">High</span>
                                @elseif ($projects->priority == 2)
                                <span class="badge badge-success">Medium</span>
                                @else
                                <span class="badge badge-light">Low</span>
                                @endif
                        </td>
                            <td>
                                @if($projects->status == 1)
                                {{'running'}}
                                @else
                                {{'not running'}}
                                @endif
                            </td>
                            <td>
                                
                                    @php
                                          $start =  now()->format('Y-m-d');
                                           $end = $projects->deadline;
                                           $diff = strtotime($end) - strtotime($start);
                                            (round($diff / 86400));
                                          
                                           
                                    @endphp
                                    @if ($end < $start)
                                    {{-- {{ now()->format('Y-m-d') }} --}}
                                    <span class="badge badge-danger">{{-round($diff / 86400)}} days over</span>
                                    @if (round($diff / 86400)<0)
                                    {{-- @php
                                    return redirect()->route('send.email');
                                    @endphp --}}
                                      
                                    @endif
                                    @elseif ((round($diff / 86400)) == 0)
                                    <span class="badge badge-warning">Today Last</span>
                                    @else
                                    <span class="badge badge-primary">{{round($diff / 86400)}} Days Left</span>
                                    @endif
                                    
        
                               
                            </td>
                            <td>
                                @php
                                         $member_info = App\Models\User::find($user->id);
                                          $member_info->email;
                                          $record = App\Models\RequestForTask::where('request_by', '=', Auth::user()->email)->where('request_to','=',$member_info->email)->where('category_based_project_id','=',$projects->id)->exists();
                                         
                                @endphp
                                @if ($record )
                                <span class="badge badge-danger">Already Assign This Task </span>
                                @else
                                <span class="badge badge-primary">Not Assign This Task </span>
                                    
                                @endif

                                
                                @php
                                      $exis = App\Models\RequestForTask::where('category_based_project_id',$projects->id)->get();
                                @endphp
                                @foreach ($exis as $exist)
                                
                                {{-- @if ($exist->exist == 1)
                                <span class="badge badge-danger">Already Assign This Task </span>
                                    @else
                                   asd
                                @endif --}}
                                    
                                @endforeach
                            </td>
                            <td class='d-flex '>
                                <a href="{{route('assign.task',[$user->id,$projects->id])}}" class="btn btn-sm btn-success">Assign Task</a>
                                <a href="{{route('remove.task',[$user->id,$projects->id])}}" class="btn btn-sm btn-danger ml-3">Remove Task</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@if(session('success'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif
@if(session('fail'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '{{session('fail')}}',
    
  })
</script>
  @endif

@endsection