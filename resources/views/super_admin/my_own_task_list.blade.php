@extends('super_admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Task Sent by authors</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Category_Name</th>
                        <th>Project Name</th>
                        <th>Task by</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created At</th>
                        <th>Deadline</th>
                        <th>Progress</th>
                        <th>Action</th>
                        
                    
                    </tr> 
                    @foreach ($user as $key=>$use)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @php
                            $a = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                            $category = App\Models\CategoryModel::find($a->category_id);
                             
                        @endphp
                        <p class="text-dark" style="font-size:14px;">{{$category->category_name}}</p>
                    </td>
                    <td>
                        @php
                            
                             $project_name = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                              
                        @endphp
                       
                        <p class="text-danger" style="font-size:14px;">{{$project_name->project_name;}}</p>
                    
                    </td>
                    <td>
                       
                         <p class="text-dark" style="font-size:14px;">{{$use->request_by}}</p>
                    </td>
                    <td>
                        @php
                             $status = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                           
                        @endphp
                        @if($status->status == 1)
                        <span class="badge bg-primary text-light">Running</span>
                        @else
                        <span class="badge bg-warning text-light">Not Running</span>
                        @endif
                        
                    </td>
                    <td>
                        @php
                            $priority = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                           
                        @endphp
                        @if ($priority->priority == 1)
                        <span class="badge bg-danger text-light">High Priority</span>
                        @elseif ($priority->priority == 2)
                        <span class="badge bg-warning text-light">Medium Priority</span>
                        @else
                        <span class="badge bg-success text-light">Low Priority</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $created_at = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                            
                        @endphp
                        <p style="font-size:13px;">{{$created_at->created_at->format('m/d/Y')}}</p>
                    </td>
                    <td>

                        @php
                        $deadline = App\Models\CategoryBasedProject::find($use->category_based_project_id);
                        
                        $start =  now()->format('Y-m-d');
                         $end = $deadline->deadline;
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
                        @if($use->compelete == Null)
                        <span class="badge badge-warning">not start the work</span>
                        @elseif ($use->compelete == 1)
                        <span class="badge badge-success">Work Done</span>
                        @else
                        <span class="badge badge-success">Start Working</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="dropbtn btn btn-success">Dropdown</button>
                            <div class="dropdown-content">
                            <a style="text-decoration: none;" href="{{route('working.onit',$use->id)}}">Working On It</a>
                            <a style="text-decoration:none;" href="{{route('working.done',$use->id)}}">Done</a>
                            
                            </div>
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
<style>
    .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }
    
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {background-color: #f1f1f1}
    
    .dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }
    </style>