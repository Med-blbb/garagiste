@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success container col-md-6 mx-auto mt-5">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger container col-md-6 mx-auto mt-5">
    {{ session('error') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger container col-md-6 mx-auto mt-5">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="container col-md-6 mx-auto mt-5">Add Client</h1>
<div class="container col-md-6 mx-auto mt-5">
<form class="form-group" action="{{ route('admin.users.add') }}" method="post">
    @csrf
    <div class="modal-body">
        <!-- Add form fields for user details -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group form-floating mb-3">
        <label for="floatingRole">Role</label>
        <input type="text" class="form-control" name="role" id="role" value="client" readonly >
        
        
    </div>
    <div class ="form-group">
        <label for="phoneNumber">Phone Number</label>
        <input type="text" class="form-control" name="phoneNumber" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" name="address" required>
    </div>
        <div class="mb-3">
            <label for="role">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('admin.show-clients') }}" class="btn btn-secondary">Clients list</a>
        <button type="submit" class="btn btn-primary">Add Client</button>
    </div>
</form>
</div>
@endsection