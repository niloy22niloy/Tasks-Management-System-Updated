@extends('super_admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Permission Edit</h3>
            </div>
            <div class="card-body">
                <form action="{{route('permission_edit.confirm',$permission_edit->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" value="{{$permission_edit->name}}" name="permission_name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection