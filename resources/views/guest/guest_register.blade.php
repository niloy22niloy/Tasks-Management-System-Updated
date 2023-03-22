@extends('guest.guest_master')
<!------ Include the above in your HEAD tag ---------->
@section('content')

    <div id="login">
        <h3 class="text-center text-white pt-5">Registration Form</h3>
        <div class="container">
            <form action="{{route('guest.store')}}" method="POST">
                @csrf
            
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Registration</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"></span></label><br>
                                <input type="submit" class="btn btn-info btn-md">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="{{route('guest.login')}}" class="text-info">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
