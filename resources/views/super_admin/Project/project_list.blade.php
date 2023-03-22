@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Project Lists</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <tr>
                            <th>Serial</th>
                            <th>Project Name</th>
                            <th>Category Name</th>
                            <th>Added_By</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($projects as $key=>$project)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$project->project_name}}</td>
                            <td>{{$project->rel_to_category->category_name}}</td>
                            <td>{{$project->rel_to_user->name}}</td>
                            <td>
                                @if($project->priority == 1)
                                <span class="badge badge-primary">High</span>
                                @elseif ($project->priority == 2)
                                <span class="badge badge-success">Medium</span>
                                @else
                                <span class="badge badge-light">Low</span>
                                @endif
                            </td>
                            <td>
                                @if($project->status == 1)
                                {{'running'}}
                                @else
                                {{'not running'}}
                                @endif
                            </td>
                            <td>{{$project->deadline}}</td>
                            <td>{{$project->created_at->format('d/m/Y')}}</td>
                            <td class="d-flex" style="margin-left:5px;">

                                <a href="{{route('project.edit.page',$project->id)}}" class="btn btn-success" style="margin-right:4px;">Edit</a>
                                <a href="#" class="btn btn-danger del" data-link="{{route('project.delete',$project->id)}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
       $(".del").click(function () {
           Swal.fire({
 title: 'Are you sure?',
 text: "You won't be able to revert this!",
 icon: 'warning',
 showCancelButton: true,
 confirmButtonColor: '#3085d6',
 cancelButtonColor: '#d33',
 confirmButtonText: 'Yes, delete it!'
}).then((result) => {
 if (result.isConfirmed) {
  var link = $(this).attr('data-link');
  window.location.href = link;
 }
})
           
       })
   });
  
  
</script>
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