@extends('super_admin.master')
@section('content')
<div class="contianer">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('update.profile',$asd->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$asd->name}}" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$asd->email}}" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{$asd->Designation}}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">About Your Work:</label>
                        <textarea id="summernote" name="About">{!! $asd->About !!}</textarea>
                    </div>
                    
                        <div class="mb-3">
                        
                            <input type="file" name="image" accept="image/*" onchange="loadFile(event)">
                            
                        </div>
                        @if($asd->image)
                        <img src="{{asset('guest_image')}}/{{($asd->image)}}" id="output" style="width:80px;" alt="">
                        @else
                        <img src="{{ Avatar::create($asd->name)->toBase64() }}" id="output" style="width:80px;" alt="">
                        @endif
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    @foreach ($errors->all() as $error)
                    <div class = "alert alert-danger">
                        <ul>
                            <li>{{ $error }}</li>
                        </ul>
                     </div>
                    
                 @endforeach
                    <div class="mb-3">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
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