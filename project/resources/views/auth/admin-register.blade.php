@extends('layouts.user-app')
@section('content')
    
    <div class="container account">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center text-primary font-monospace">Create New Account</h1>
                <form action="{{ route('admin-register') }}" class="text-primary" method="POST">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}">
                        <label for="floatingInput">Organization Name</label>
                        <span class="text-danger">@error('name')
                            {{ $message }}
                        @enderror</span>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                        <label for="floatingInput">Email</label>
                        <span class="text-danger">@error('email')
                            {{ $message }}
                        @enderror</span>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="password" class="form-control form-control-sm" name="password" id="password1">
                        <label for="floatingPassword">Password</label>
                        <span class="text-danger">@error('password')
                            {{ $message }}
                        @enderror</span>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control form-control-sm" name="password_confirmation" id="password2">
                        <label for="floatingPassword">Confirm Password</label>
                    </div>

                    <div class="m-1 text-dark">
                        <input type="checkbox" onclick="showPassword()">Show Password
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-outline-danger mt-4" type="submit">Create</button>
                    </div>

                    <div class="m-3 text-center">
                        <p>Already have an account? 
                            <a href="{{ route('view.login') }}">Login</a>
                        </p>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
@endsection
    
    <script>
        function showPassword() {
            var x = document.getElementById("password1");
            var y = document.getElementById("password2");
            if (x.type == "password") {
                x.type = "text";
            }
            if (y.type == "password") {
                y.type = "text";
            }
             else {
                x.type = "password";
                y.type = "password";
            }
        } 
    </script>