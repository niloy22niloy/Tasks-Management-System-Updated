@extends('super_admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Requests List</h3>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Serial</th>
                            
                            <th>Request Send By Emai</th>
                            <th>Task Name</th>
                            <th>Category Name</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Compeletion</th>
                            <th>Request Send Date</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($requests as $key=>$request)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('requester.description',$request->id)}}">{{$request->request_by}}</a></td>
                            <td>
                                @php
                                     $task_name = App\Models\CategoryBasedProject::find($request->category_based_project_id);
                                    echo $task_name->project_name;
                                @endphp
                            </td>
                            <td>
                                
                                @php
                                 
                                      $task_name = App\Models\CategoryBasedProject::find($request->category_based_project_id);
                                      $task_name->category_id;
                                      $category = App\Models\CategoryModel::find($task_name->category_id);
                                      echo $category->category_name;

                                @endphp
                            </td>
                            <td>
                                @if ($task_name->priority == 1)

                                    <span class="badge bg-danger text-white">High</span>
                                    @elseif ($task_name->priority == 2)
                                    <span class="badge bg-primary text-white">Medium</span>
                                   @else
                                   <span class="badge bg-success text-white">Low</span>
                                @endif
                            </td>
                           
                            <td>
                                @if($request->status == 0)
                                <span class="badge bg-primary text-white">Not Accepted Yet</span>
                                @else
                                <span class="badge bg-danger text-white">Accepted</span>
                                @endif
                            </td>
                            <td>
                                @if($request->compelete == 2)
                                <span class="badge bg-primary text-white">Working</span>
                                @elseif ($request->compelete == 1)
                                <span class="badge bg-danger text-white">Done</span>
                                @else
                                <span class="badge bg-success text-white">Not Start</span>
                                @endif
                            </td>
                            <td>
                                {{$request->created_at}}
                            </td>
                            <td>
                                @php
                                
                                 $deadline_find = App\Models\CategoryBasedProject::where('added_by',Auth::user()->id)->where('project_name','=',$task_name->project_name)->get();
                                     
                                     foreach ($deadline_find as  $deadline) {
                                    
                                         echo $deadline->deadline;
                                       
                                     }
                                    //  foreach ($dead as $d) {

                                    //     echo $d->deadline;
                                    //  }
                                     
                                    
                                @endphp
                               
                            </td>
                            <td class="text-center">
                                {{-- <div class="btn-group">
                                <a href="{{route('accept.tasks',$request->id)}}" class="btn btn-primary">Accept Tasks </a>
                                <a href="{{route('accept.tasks',$request->id)}}" class="btn btn-danger">Delete </a>
                            </div> --}}
                            <div class="d-flex text-center">
                                <a href="{{route('accept.tasks',$request->id)}}" type="button" class = "btn btn-primary btn-sm" style="margin-right:5px;">Accept</a>
                                <a href="{{route('request.delete',$request->id)}}" type="button" class = "btn btn-primary btn-sm">Delete</a>
                                
                              </div>
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
@endsection