@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Category_Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('category.edit.confirm',$category_edit->id)}}" method="POST">
                        @csrf
                    <div class="mb-3">
                        
                        
                        <label for="" class="form-label">Category_Name</label>
                        <input type="text" class="form-control" name="category_name" value="{{$category_edit->category_name}}">
                    
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
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