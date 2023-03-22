@extends('super_admin.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{$user->name}}'s Profile</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{$user->name}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{$user->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Designation</label>
                        <input type="text" class="form-control" value="{{$user->Designation}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">About Your Work:</label>
                        <p>{!! $user->About !!}</p>
                    </div>
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
@endsection