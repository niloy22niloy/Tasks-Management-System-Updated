@extends('super_admin.master')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 m-auto">
<div class="card">
  <div class="card-header">
    <h3>Members List</h3>
  </div>
  <div class="card-body">
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th>Role</th>
            <th>action</th>
        </tr>
        @foreach ($sss as $user)
<tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->Designation}}</td>
    <td>
        @foreach ($user->getRoleNames() as $ro)
        <span class="badge bg-success text-light">{{$ro}}</span>
        
        @endforeach
        
        
       



        {{-- @foreach ($all_users_with_all_their_roles as $rola)
       {{ $rola->getRoleNames()}}
        
    @endforeach --}}

    </td>
    <td>
      
      @foreach (Auth::user()->getRoleNames() as $lo)
      @if ($lo == 'Author')
      <div class="dropdown">
          
        <button class="dropbtn btn btn-success">Dropdown</button>
        <div class="dropdown-content">
        <a style="text-decoration:none;" href="{{route('assigning.newtask',$user->id)}}">Assign Task</a>
        <a style="text-decoration:none;" href="{{route('user.profile',$user->id)}}">Visit Profile</a>
        
        </div>
      </div>
      @else
      @foreach ($user->getRoleNames() as $ro)
      {{-- <span class="badge bg-success text-light">{{$ro}}</span> --}}
      @if ($ro == 'Member')
      {{-- <a style="text-decoration:none;" href="{{route('assigning.newtask',$user->id)}}">Visit Profile</a> --}}
      <div class="dropdown">
        
        <button class="dropbtn btn btn-success">Dropdown</button>
        <div class="dropdown-content">
        
        <a style="text-decoration:none;" href="{{route('user.profile',$user->id)}}">Visit Profile</a>
        
        </div>
      </div>
      
      
      @endif
      @endforeach
      @endif
      @endforeach
      
      
      
        
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
<style>
    .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }
    
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {background-color: #f1f1f1}
    
    .dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }
    </style>