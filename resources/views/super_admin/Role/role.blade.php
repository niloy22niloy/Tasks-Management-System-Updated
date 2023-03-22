@extends('super_admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-sm-8">
       <div class="card">
        <div class="card-header">
            <h3>Permission Show</h3>

        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <tr>
                    <th>Serial</th>
                    <th>Permission Name</th>
                    <th>Action</th>
                </tr>
                @foreach ($permissions_list as $key=>$permission)
                <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$permission->name}}</td>
                   <td>
                    <a href="{{route("permission.edit",$permission->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{route('permission.delete',$permission->id)}}" class="btn btn-danger">Delete</a>
                   </td>
                </tr>
                    
                @endforeach
                
            </table>
        </div>
       </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <form action="{{route('permission.store')}}" method="POST">
                    @csrf
                <div class="card-header">
                    <h3>Add Permission</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" class="form-control"  name="permission_name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                     @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Role List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Role</th>
                        <th>Permission</th>
                      
                    </tr>
                    @foreach ($roles as $key=>$role)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach ($role->getAllPermissions() as $rol)
                            
                            <span class="badge bg-primary text-white">{{$rol->name}}</span>
                                
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('role.delete',$role->id)}}" class="btn btn-success">Delete</a>
                        </td>
                        
                    </tr>
                        
                    @endforeach

                </table>
            </div>

        </div>
        </div>
        <div class="col-lg-4">
            <form action="{{route("role.store")}}" method="POST">
                @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Role Name</label>
                        <input type="text" name="role_name" class="form-control">
                        @error('role_name')
                        <span class="text-danger">{{$message}}</span>
                     @enderror

                    </div>
                    <div class="mb-3">
                        @foreach ($permissions_list as $permission)
                        <div class="form-check">
                            
                                
                            
                            <input class="form-check-input" name="permission_name[]" type="checkbox" value="{{$permission->id}}">
                            <label class="form-check-label">
                              {{$permission->name}}
                            </label>
                          </div>
                          @endforeach
                          
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <div class="row">
       <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>User Role List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>User Name</th>
                        <th>Role Name</th>
                        <th>Permission Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            @forelse ($user->getRoleNames() as $roll)
                           
                            <span class="badge bg-success text-white"> {{$roll}}</span>
                            @empty
                            <span class="badge badge-pill badge-secondary">Not Assigned</span>
                                
                            @endforelse
                        </td>
                        <td>
                            <div>
                            @forelse ($user->getAllPermissions() as $permissions) 

                            <button type="button" class="btn btn-sm btn-outline-primary mb-2" style="">{{$permissions->name}}</button>
                                  @empty
                                  <span class="badge badge-pill badge-secondary ">Not Assigned</span>
                            @endforelse
                        </div>
                        </td>
                        <td class="d-flex">
                            <a href="{{route('remove.role',$user->id)}}" class="btn btn-danger" style="margin-right:4px;">Remove</a>
                            <a href="{{route('edit.user.role.permission',$user->id)}}" class="btn btn-success">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
            </div>
        </div>

       </div>
       <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Assign Role</h3>
            </div>
            <div class="card-body">
                <form action="{{route('assign.role')}}" method="POST" >
                    @csrf
                
                <div class="mb-3">
                    <select name="user_id" class="form-control js-example-basic-single" id="">
                        <option value="">--Select User---</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                            
                        @endforeach
                    </select>
                   
                    
                </div>
                <div class="mb-3">
                    <select name="role_id" class="form-control js-example-basic-single" id="">
                        <option value="">--Select Role---</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                            
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Assign Role</button>
                </div>
                @error('user_id')
                <span class="text-danger">{{$message}}</span>
             @enderror
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
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection