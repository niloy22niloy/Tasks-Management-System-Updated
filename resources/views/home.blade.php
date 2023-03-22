
@extends('super_admin.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Hello,{{Auth::user()->name}}
             
             {{-- @if(Auth::user()->getRolenames())         
      <td>asd</td>         
@else
      <td>dds</td>        
@endif --}}
            
             
         
            
             
            
        
        </li>
        </ol>
      </nav>
</div>



<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="container">
   
    <div class="row">
       
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if (count(Auth::user()->getRolenames()) == 0)
                    <h3>Which Role Do You Want?</h3>
                    <div class="mb-3">
                        <form action="{{route('assign.role.tologer')}}" method="POST" >
                            @csrf
                        <select name="role_id" class="form-control js-example-basic-single" id="">
                            <option value="">--Select Role---</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                                
                            @endforeach
                        </select>
                     <input type="submit" class="btn btn-success mt-3">
                    </div> 
                        @else
                        @foreach ( Auth::user()->getRolenames() as $name)
                        <h3 class="text-danger text-center">You Are A {{$name}}</h3></span> 
                        @endforeach
                    @endif
                     
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
