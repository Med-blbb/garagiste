<!-- resources/views/admin/users.blade.php -->
@extends('layouts.auth-master')

@section('content')
<h1>All Users</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
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
@endsection