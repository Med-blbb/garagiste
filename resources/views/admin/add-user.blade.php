@extends('layouts.main-headerbar')
@include('layouts.head')
@extends('layouts.main-sidebar')


<form method="post" action="{{ route('admin.users.add') }}">
    @csrf <!-- Add CSRF token for security -->
    <!-- Your form fields -->
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Add User</button>
</form>
