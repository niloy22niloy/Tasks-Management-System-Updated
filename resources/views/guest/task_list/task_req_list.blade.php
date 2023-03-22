
@extends('guest.dashboard.dashboard_master')


@section('content')

<div class="container-fluid">
  
    <div class="row">
      <div class="col-lg-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Requests Task Lis</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center  mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Task Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Request</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Days Left</th>
                     
                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proggress</th>
                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    
                    
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                
                  @foreach ($task_req_list as $task_req)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        {{-- <div>
                          <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                        </div> --}}
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">
                            @php
                                $asd = App\Models\User::where('email',$task_req->request_to)->get()
                                
                            @endphp
                            @foreach ($asd  as $as)
                            {{$as->name}}
                                
                            @endforeach
                            
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                           {{$task_req->request_to}}
                          </p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">
                        @php
                            $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                             echo $sss->project_name;
                        @endphp

                      </p>
                      
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">
                            @php
                             $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                              $sss->category_id;
                             $category = App\Models\CategoryModel::find($sss->category_id);
                             echo $category->category_name;
                        @endphp
                        </p>
                        
                      </td>
                    <td class="align-middle text-center text-sm">
                        @if ($task_req->status == 0)
                        <span class="badge badge-sm bg-gradient-success">
                              Not Responding Yet
                        </span>
                        @else
                        <span class="badge badge-sm bg-gradient-danger">
                            Accepted
                      </span>
                        @endif
                        
                       
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">
                       @php
                          $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                           
                       @endphp
                       @if ($sss->status == 2)
                       <span class="badge badge-sm bg-gradient-success">
                        Not Running Yet
                  </span>
                  @elseif($sss->status == 1)
                  <span class="badge badge-sm bg-gradient-danger">
                    Running
              </span>
                       @endif
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                    
                       @php
                         $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                       @endphp
                      @if($sss->priority == 1)

                      <span class="badge badge-sm bg-gradient-danger">
                       High
                  </span>
                      @elseif ($sss->priority == 2)
                      <span class="badge badge-sm bg-gradient-success">
                        Medium
                  </span>
                  @elseif ($sss->priority == 3)
                      <span class="badge badge-sm bg-gradient-primary">
                        Low
                  </span>
                      @endif
                       
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        @php
                          $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                          echo $sss->created_at;
                        @endphp
                      </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">
                            @php
                                  $sss = App\Models\CategoryBasedProject::find($task_req->category_based_project_id);
                                   echo $sss->deadline;
                                  

                                 
                            @endphp
                            
                        </span>
                    </td>
                    <td class="align-middle">
                        {{-- <a href="" class="btn btn-success">Request<br> For This Tasks</a> --}}
                        <span class="text-secondary text-xs font-weight-bold">
                            @php
                                  $start =  now()->format('Y-m-d');
                                   $end = $sss->deadline;
                                   $diff = strtotime($end) - strtotime($start);
                                    (round($diff / 86400));
                                  
                                   
                            @endphp
                            @if ($end < $start)
                            {{-- {{ now()->format('Y-m-d') }} --}}
                            <span class="badge badge-sm bg-gradient-primary">{{-round($diff / 86400)}} days over</span>
                            @if (round($diff / 86400)<0)
                            {{-- @php
                            return redirect()->route('send.email');
                            @endphp --}}
                              
                            @endif
                            @else
                            <span class="badge badge-sm bg-gradient-success">{{round($diff / 86400)}} Days Left</span>
                            @endif
                            

                        </span>
                    </td>
                    <td class="align-middle text-center">
                      @if($task_req->compelete == 2)
                      <span class="badge badge-sm bg-gradient-primary">Working on it</span>
                      @elseif($task_req->compelete == 0)
                      <span class="badge badge-sm bg-gradient-success">Has Not Starting The Work</span>
                      @else
                      <span class="badge badge-sm bg-gradient-danger">Work Done</span>

                      @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('work.update',$task_req->id)}}">Working</a></li>
                          <li><a class="dropdown-item" href="{{route('work.done',$task_req->id)}}">Done</a></li>
                          <li><a class="dropdown-item" href="{{route('work.delete',$task_req->id)}}">Delete</a></li>
                          
                        </ul>
                      </div>
                    </td>
                    
                  </tr>
          
           
            
           
              
            </tr> 
                  @endforeach
                     
                </tbody>
              </table>
            </div>
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