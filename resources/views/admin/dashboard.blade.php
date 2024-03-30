<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.auth-master')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome to Admin Dashboard</h1>

    <h3><a href="{{ route('admin.users') }}" class="btn btn-primary">Show all the users</a></h3>
</body>

</html>