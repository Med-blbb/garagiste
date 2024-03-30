@include('layouts.main-headerbar')
@extends('layouts.head')
@extends('layouts.main-sidebar')


<form method="post" class="container col-md-6 mx-auto mt-5" action="{{ route('admin.users.add') }}">
    @csrf <!-- Add CSRF token for security -->
    <div class="mb-3">
        <input type="text" class="form-control" name="name" placeholder="Name" required>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="role" placeholder="Role">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="address" placeholder="Address">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="userID" placeholder="UserID">
    </div>
    
    <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>

    <button type="submit" class="btn btn-primary">Add User</button>
</form>