@extends('layouts.auth-master')
@include('layouts.partials.head')

@section('content')
<div class="container h-100 d-flex justify-content-center align-items-center">

    <div class="card card-login border-0 shadow-lg">
        <div class="card-body py-5">
            <form method="post" action="{{ route('login.perform') }}">
                @csrf
                <div class="text-center mb-4">
                    <h3 class="mb-4 font-weight-bold text-primary">Login</h3>
                </div>

                @include('layouts.partials.messages')

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                    <label for="floatingName">Email or Username</label>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" value="1" id="remember">
                        <label class="custom-control-label" for="remember">Remember me</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Login</button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Don't have an account? <a href="{{ route('register.perform') }}" class="text-primary">Sign up</a></p>
                    <a href="{{ route('forget.password.get') }}" class="text-muted">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
