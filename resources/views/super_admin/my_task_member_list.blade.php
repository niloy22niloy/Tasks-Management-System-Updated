@extends('super_admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-16">
            <div class="card">
                <div class="card-header">
                    <h1>My Task Member Lists</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Serial</th>
                            <th>Task Taker Name</th>
                            <th>Category Name</th>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Created_At</th>
                            <th>Deadline</th>
                            <th>Progress</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($my_memberlist as $key=>$my_member)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$my_member->request_to}}</td>
                        <td>
                            @php
                                $category_name = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();
                                
                            @endphp
                            @foreach ($category_name as $category_nam)
                            @php
                            $category_nam;
                                $category = $category_nam->category_id
                                @endphp
                            @endforeach
                            @php
                                $cat = App\Models\CategoryModel::find($category);
                                 echo $cat->category_name;
                            @endphp
                           
                        </td>
                        <td>
                            @php
                            $project_name = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();
                            
                        @endphp
                        @foreach ($project_name as $project)
                        {{$project->project_name}}
                            
                        @endforeach
                        </td>
                        <td>
                            @php
                                $status = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();
                            @endphp
                            @foreach ($status as $statu)
                            @if ($statu->status == 1)
                            <span class="badge bg-primary text-light">Running</span>
                            @elseif ($statu->status == 2)
                            <span class="badge bg-danger text-light">not running</span> 
                            @endif
                                
                            @endforeach
                        </td>
                        <td>
                            @php
                            $priority = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();

                        @endphp
                        @foreach ($priority as $priorit)
                        @if($priorit->priority==1)
                        <span class="badge bg-primary text-light">High Priority</span>
                        @elseif($priorit->priority==2)
                        <span class="badge bg-danger text-light">Medium Priority</span>
                        @else
                        <span class="badge bg-success text-light">Low Priority</span>
                           @endif 
                        @endforeach
                        </td>
                        <td>
                            @php
                            $created_at = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();

                        @endphp
                        @foreach ($created_at as $create)
                        
                        <p style="font-size:13px;">{{$create->created_at->format('d-M-Y')}}</p>
                   
                        
                            
                        @endforeach
                        </td> 
                        <td>
                            @php
                        $deadline = App\Models\CategoryBasedProject::where('id',$my_member->category_based_project_id)->get();
                          foreach ($deadline  as $dead) {
                            # code...
                            
                            $start =  now()->format('Y-m-d');
                            $end = $dead->deadline;
                            $diff = strtotime($end) - strtotime($start);
                            (round($diff / 86400));
                            if ($end < $start){
                                $a = -round($diff / 86400);
                                echo "<span class='badge badge-danger'>".$a." days over"."</span>";
                            }elseif ((round($diff / 86400)) == 0) {
                                # code...
                                echo "<span class='badge badge-warning'>"."Last Day"."</span>";
                            }else{
                                $b = round($diff / 86400);
                               echo "<span class='badge badge-primary'>".$b." days remaining"."</span>";
                            }
                          }
                        
                        // $start =  now()->format('Y-m-d');
                        //  $end = $deadline->deadline;
                        //  $diff = strtotime($end) - strtotime($start);
                        //   (round($diff / 86400));
                        
                         
                  @endphp
                  {{-- @if ($end < $start)
                  {{ now()->format('Y-m-d') }} 
                  <span class="badge badge-danger">{{-round($diff / 86400)}} days over</span>
                  @if (round($diff / 86400)<0) 
                   @php
                  return redirect()->route('send.email');
                  @endphp 
                    
                  @endif
                  @elseif ((round($diff / 86400)) == 0)
                  <span class="badge badge-warning">Today Last</span>
                  @else
                  <span class="badge badge-primary">{{round($diff / 86400)}} Days Left</span>
                  @endif  --}}
                  
                        </td>
                        <td>
                            @if($my_member->compelete == 1)
                            <span class="badge badge-warning">Work Done
                                @elseif($my_member->compelete == Null)
                                <span class="badge badge-warning">not start the work</span>
                                @else

                            <span class="badge badge-danger">Start Working</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('delete.mytaskmembers',$my_member->id)}}" class="btn btn-success">Delete</a>
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