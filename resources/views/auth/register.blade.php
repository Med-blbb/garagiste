@extends('layouts.auth-master')

@section('content')
<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="card card-register shadow-sm border-0 rounded-lg p-4" style="width: 500px;">
        <div class="card-body">
            <form method="post" action="{{ route('register.perform') }}">
                @csrf

                <h1 class="h3 mb-4 fw-normal text-center">Register</h1>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus>
                    <label for="floatingname">Name</label>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                    <label for="floatingEmail">Email address</label>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <select class="form-control form-control-lg" name="role" id="floatingRole" required autofocus>
                        <option value="" selected disabled>Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="mechanic">Mechanic</option>
                        <option value="client">Client</option>
                    </select>
                    <label for="floatingRole">Role</label>
                    @error('role')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control form-control-lg" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="Phone" required>
                    <label for="floatingPhone">Phone</label>
                    @error('phoneNumber')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="text" class="form-control form-control-lg" name="address" value="{{ old('address') }}" placeholder="Address" required>
                    <label for="floatingAddress">Address</label>
                    @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control form-control-lg" name="password" value="{{ old('password') }}" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control form-control-lg" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button class="w-100 btn btn-lg btn-primary rounded-pill" type="submit">Register</button>

                @include('auth.partials.copy')
            </form>
        </div>
    </div>
</div>
@endsection
