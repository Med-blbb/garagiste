<!-- resources/views/admin/users.blade.php -->
@extends('layouts.main-headerbar')
@include('layouts.head')
@extends('layouts.main-sidebar')

<h1>All Users</h1>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <!-- Add more columns if needed -->
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h3><a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a></h3>
