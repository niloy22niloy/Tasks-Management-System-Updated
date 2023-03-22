@extends('guest.guest_master')
<!------ Include the above in your HEAD tag ---------->
@section('content')

    <div id="login">
        <h3 class="text-center text-white pt-5">Pass Reset</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{route('guest.pass.req.send')}}" method="post">
                            @csrf
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <input type="email" name="email"  class="form-control">
                            </div>
                            <div class="form-group">
                               <button class="btn btn-success">Submit</button>
                            </div>

                         {{-- <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                                <a href="{{route('guest.pass.reset.req')}}" class="text-info">Reset Password</a>
                            </div> --}}
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
@endsection
