@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3>CategoryWise Project Insert</h3>
                </div>
                <div class="card-body">
                   <form action="{{route('categorywise.project.insert')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <select name="category_id" id="" class="form-control">
                        <option value="">---Select Category-----</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                        

                    </select>
                </div>
                @if($errors->has('category_id'))
<div class="alert alert-danger" role="alert">
    {{ $errors->first('category_id') }}
</div>
    
@endif
                {{-- @if ($errors->project_name)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}



                <div class="mb-3">
                    <label for="" class="form-label">Project Name</label>
                    <input type="text" name="project_name" class="form-control">
                </div>
                @if($errors->has('project_name'))
<div class="alert alert-danger" role="alert">
    {{ $errors->first('project_name') }}
</div>
    
@endif

                <div class="mb-3">
                    <label for="" class="form-label">Added By</label>
                    <input type="text" name="added_by" value="{{Auth::user()->id}}" class="form-control" readonly> 
                 </div>
                <div class="mb-3">
                    <label for="" class="form-label">Priority Level</label>
                    <select name="priority" id="" class="form-control">
                        <option value="">---Select Prioroty-----</option>
                        <option value="1">High</option>
                        <option value="2">Medium</option>
                        <option value="3">Low</option>

                    </select>
                    
                </div>
                @if($errors->has('priority'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('priority') }}
                    </div>
                        
                    @endif
                     <div class="mb-3">
                        <label for="" class="form-label">Dead Line</label>
                        <input type="date"  name="deadline">
                     </div>

                     @if($errors->has('deadline'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('deadline') }}
                    </div>
                        
                    @endif
                     
                     <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">---Select Status-----</option>
                            <option value="1">Running</option>
                            <option value="2">Not Running</option>
                            
    
                        </select>
                     </div>
                     @if($errors->has('status'))
                     <div class="alert alert-danger" role="alert">
                         {{ $errors->first('status') }}
                     </div>
                         
                     @endif
                     <div class="mb-3">
                        <button class="btn btn-primary">Submit</button>
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