@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>Project Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('project.update',$projects->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        
                        <select name="category_id" id="" class="form-control">
                            <option value="">---Select category-----</option>
                            @foreach ($categories as $category)
                            <option @if($projects->category_id == $category->id) 
                                selected
                                @endif
                                value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        
                           
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text"  class="form-control" value="{{$projects->rel_to_category->category_name}}" readonly>
                        
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" name="project_name" class="form-control" value="{{$projects->project_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Priority</label>
                        <select name="priority" id="" class="form-control">
                            <option value="">---Select Prioroty-----</option>
                            <option @if($projects->priority == 1) selected @endif  value="1">High</option>
                            <option @if($projects->priority == 2) selected @endif value="2">Medium</option>
                            <option @if($projects->priority == 3) selected @endif value="3">Low</option>
    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Priority</label>
                        <input type="text" class="form-control"  readonly value= @if($projects->priority == 2)
                        medium
                        @elseif($projects->priority == 1)
                        High Priority
                        @else
                        Low Priority
                        @endif
                        > 
    
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Dead Line</label>
                        <input type="date" value="{{$projects->deadline}}"  name="deadline">
                     </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Deadline</label>
                        <input type="text"  class="form-control" value="{{$projects->deadline}}" readonly>
                    </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">---Select Status-----</option>
                            <option @if($projects->status == 1) selected @endif value="1">Running</option>
                            <option @if($projects->status == 2) selected @endif value="2">Not Running</option>
                            
    
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <input type="text"  class="form-control" value=
                        @if($projects->status == 1)
                        Running
                        @else
                        Not_running
                        @endif
                         readonly>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">update</button>
                    </div>
                     

                </form>
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