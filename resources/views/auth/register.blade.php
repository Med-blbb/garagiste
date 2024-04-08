@extends('layouts.auth-master')

@section('content')
<div class="container h-100 d-flex justify-content-center align-items-center vh-100">
    <div class="card card-register shadow-sm border-primary rounded-lg mw-100">
        <div class="card-body py-5">
            <form method="post" action="{{ route('register.perform') }}">
                @csrf

                <h1 class="h3 mb-3 fw-normal text-center" style="font-size: 2rem;">Register</h1>

                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus>
                    <label for="floatingname">Name</label>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                    <label for="floatingEmail">Email address</label>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <select class="form-control" name="role" id="floatingRole" required autofocus>
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="editor">Mechanician</option>
                        <option value="user">User</option>
                    </select>
                    <label for="floatingRole">Role</label>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button class="w-100 btn btn-lg btn-primary rounded-pill" type="submit">Register</button>

                @include('auth.partials.copy')
            </form>
        </div>
    </div>
</div>
@endsection
