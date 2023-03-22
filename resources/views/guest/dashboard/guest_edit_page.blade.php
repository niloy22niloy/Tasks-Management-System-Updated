@extends('guest.dashboard.dashboard_master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Profile</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Profile</h6>
      </nav>
      
    </div>
  </nav>
<div class="container">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('guest.update',$asd->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name"  value ="{{$asd->name}}" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" value = "{{$asd->email}}" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Designation</label>
                      <input type="text" name="designation"  value ="{{$asd->designation}}" class="form-control">
                  </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Work Description</label>
                        <textarea id="summernote" name="work_description">
                            {!!$asd->description!!}
                        </textarea>
                    </div>

                    <div class="mb-3">
                        
                        <input type="file" name="image" accept="image/*" onchange="loadFile(event)">
                        
                    </div>
                    <img src="{{asset('guest_image')}}/{{$asd->photo}}" id="output" style="width:80px;" alt="">
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
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
<script>
    var loadFile = function(event) {
       var reader = new FileReader();
       reader.onload = function(){
         var output = document.getElementById('output');
         output.src = reader.result;
       };
       reader.readAsDataURL(event.target.files[0]);
     };
   </script>

<script>
    $(document).ready(function() {
  $('#summernote').summernote();
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