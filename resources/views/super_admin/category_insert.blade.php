@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-4">
                <div class="card-header text-center">
                    <h3>Add Categories</h3>
                </div>
                <form action="{{route('category.submit')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                     @enderror
                    </div>
                    <div class="mb-3">
                        
                        <input type="hidden" class="form-control" name="added_by" value="{{Auth::user()->id}}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Insert</button>
                    </div>
                </div>
            </form>
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