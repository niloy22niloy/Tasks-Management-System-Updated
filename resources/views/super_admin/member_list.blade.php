@extends('super_admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Member List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>designation</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($member_list as $key=>$member)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{$member->email}}</td>
                        <td>{{$member->designation}}</td>
                        <td>
                            <a href="{{route('member.details',$member->id)}}" class="btn btn-primary">Details</a>
                        </td>
                    </tr>
                        
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection