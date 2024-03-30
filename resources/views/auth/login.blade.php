@extends('layouts.auth-master')

@section('content')
<form method="post" action="{{ route('login.perform') }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <img class="mb-4" src="{!! url('images/bootstrap-logo.svg') !!}" alt="" width="72" height="57">

    <h1 class="h3 mb-3 fw-normal">Login</h1>

    @include('layouts.partials.messages')

    <div class="form-group form-floating mb-3">
        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
        <label for="floatingName">Email or Username</label>
        @if ($errors->has('username'))
        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
        @endif
    </div>

    <div class="form-group form-floating mb-3">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
        <label for="floatingPassword">Password</label>
        @if ($errors->has('password'))
        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group mb-3">
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember" value="1">
    </div>
    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="checkbox">
                <label>
                    <a href="{{ route('forget.password.get') }}">Reset Password</a>
                </label>
            </div>
        </div>
    </div>

    <button class="w-50 btn btn-lg btn-primary mt-3" type="submit">Login</button>
    <a href="{{ route('register.perform') }}" class="w-50 mt-3 p-2 btn btn-warning">Sign-up</a>



    @include('auth.partials.copy')
</form>
@endsection