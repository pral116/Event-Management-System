@extends('layouts.user-app')
@section('content')
    
    <div class="container account">
        <div class="card" style="width: 400px;">
            <div class="card-body">
                <h1 class="card-title text-center text-primary font-monospace">Login</h1>
                <form action="{{ route('login') }}" class="text-primary" method="POST">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>                        
                    @endif
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                        <label for="floatingInput">Email</label>
                        <span class="text-danger">@error('email')
                            {{ $message }}
                        @enderror</span>
                    </div>

                    <div class="form-floating mb-2">
                        <input type="password" class="form-control form-control-sm" name="password" id="password">
                        <label for="floatingPassword">Password</label>
                        <span class="text-danger">@error('password')
                            {{ $message }}
                        @enderror</span>
                    </div>

                    <div class="m-1 text-dark">
                        <input type="checkbox" onclick="showPassword()">Show Password
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-outline-danger mt-4" type="submit">Login</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
@endsection
    
    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type == "password") {
                x.type = "text";
            }
             else {
                x.type = "password";
            }
        } 
    </script>

</html>