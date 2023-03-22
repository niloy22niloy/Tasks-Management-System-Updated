@extends('guest.guest_master')
<!------ Include the above in your HEAD tag ---------->
@section('content')

    <div id="login">
        <h3 class="text-center text-white pt-5">Pass {{$token}} Reset</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{route('pass.reset')}}" method="post">
                            @csrf
                            <h3 class="text-center text-info">Password Update</h3>
                            <input type="hidden" name="token" value={{$token}}>
                            <div class="form-group">
                                
                                <label for="username" class="text-info">New Password:</label><br>
                                <input type="Password" name="new_password"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Confirm Password:</label><br>
                                <input type="Password" name="password_confirmation"  class="form-control">
                            </div>
                            <div class="form-group">
                               <button class="btn btn-success">Update</button>
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
@endsection
