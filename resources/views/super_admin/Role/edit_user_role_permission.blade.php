@extends('super_admin.master')
@section('content')
<div class="contianer-fluid">
    <div class="row">
        <div class="col-lg-5 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit User Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('permission.update')}}" method="POST">
                        @csrf
                        <div class="mb-3 d-flex">
                            <div>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            {{-- <h4 class="text-danger">User: {{$user->name}}</h4> --}}
                            {{-- <span class="badge text-bg-warning"></span> --}}
                            
                            <button type="button" class="btn btn-primary">{{$user->name}}</button>
                            
                        </div>
                        
                        <div class='ml-auto'>
                            @foreach ($user->getRoleNames() as $sd)
                            {{-- <span class="badge bg-primary text-light"></span> --}}
                            <button type="button" class="btn btn-sm btn-info">{{$sd}}</button>
                            @endforeach
                        </div>
                            
                           
                        </div>
                        
                        <div class="mb-3">
                            @foreach ($permissions_list as $permission)
                        <div class="form-check">
                            
                                
                            
                            <input {{($user->hasPermissionTo($permission->name))?'checked':''}} class="form-check-input" name="permission_name[]" type="checkbox" value="{{$permission->id}}">
                            <label class="form-check-label">
                              {{$permission->name}}
                            </label>
                          </div>
                          @endforeach
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

