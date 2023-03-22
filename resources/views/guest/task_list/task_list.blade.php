@extends('guest.dashboard.dashboard_master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Task</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">List Of Author</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Profile</h6>
    </nav>
    
  </div>
</nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Authors table</h6>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Request</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Priority</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      
                      
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tasks_all as $tasks)
                    {{-- @php
                    $asd = App\Models\User::where('id',$tasks->added_by)->get()
                    @endphp
                        @foreach ($asd as $as )
                        {{$as->name}}
                            
                        @endforeach --}}
                        <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                {{-- <div>
                                  <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div> --}}
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">
                                    @php
                    $asd = App\Models\User::where('id',$tasks->added_by)->get()
                    @endphp
                        @foreach ($asd as $as )
                        {{$as->name}}
                            
                        @endforeach
                                  </h6>
                                  <p class="text-xs text-secondary mb-0">
                                    @php
                                    $asd = App\Models\User::where('id',$tasks->added_by)->get();
                                    @endphp
                                        @foreach ($asd as $as )
                                        {{$as->email}}
                                            
                                        @endforeach
                                  </p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0">{{$tasks->project_name}}</p>
                              
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">
                                    @php
                                         $asd = App\Models\CategoryModel::where('id',$tasks->category_id)->get()
                                    @endphp
                                     @foreach ($asd as $as )
                                     {{$as->category_name}}
                                         
                                     @endforeach
                                </p>
                                
                              </td>
                              <td>
                                @php
                                $b = App\Models\RequestForTask::where('category_based_project_id',$tasks->id)->get()
                                @endphp
                                @foreach ($b as $s )
                                @if ($s->status == 1)
                                <span class="badge badge-sm bg-gradient-danger">
                                  Accepted
                                </span>
                                @else
                                <span class="badge badge-sm bg-gradient-success">
                                  Not Accepted Yet
                                </span>
                                  
                                @endif
                                  
                                @endforeach
                               
                              </td>
                              <td>
                                @if ($tasks->priority == 1)
                                <span class="badge badge-sm bg-gradient-danger">
                                  High
                                </span>
                                @elseif ($tasks->priority == 2)
                                <span class="badge badge-sm bg-gradient-success">
                                  Medium
                                </span>
                                @else
                                <span class="badge badge-sm bg-gradient-warning">
                                  Low
                                </span>
                                @endif
                              </td>
                            <td class="align-middle text-center text-sm">
                              
                                @if($tasks->status == 2)
                                <span class="badge badge-sm bg-gradient-success">
                                    Not Running Yet
                              </span>
                              @elseif($tasks->status == 1)
                              <span class="badge badge-sm bg-gradient-danger">
                                Running
                          </span>
                              @endif
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">{{$tasks->created_at}}</span>
                            </td>
                            <td class="align-middle">
                                <span class="text-secondary text-xs font-weight-bold">{{$tasks->deadline}}</span>
                            </td>
                            <td class="align-middle text-center">
                                {{-- <a href="{{route('req.task',$tasks->id)}}" class="btn btn-sm btn-success">Request<br> For This Tasks</a> --}}
                                <div class="dropdown">
                                  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                  </a>
                                
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{route('req.task',$tasks->id)}}">Request Task</a></li>
                                    
                                    
                                  </ul>
                                </div>


                              </td>
                          </tr>
                    @endforeach
                   
                    
                   
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </main>
  
       
     
  @if(session('fail'))
  <script>
     
  Swal.fire({
  icon: 'error',
  title: '{{session('fail')}}',
  text: 'Something went wrong!',
  footer: '<a href="">Why do I have this issue?</a>'
})
  </script>
  @endif
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