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

<h1 class="container col-md-6 mx-auto mt-5">Edit Client</h1>
<form method="post" class="container col-md-6 mx-auto mt-5" action="{{ route('admin.edit-client', $client) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <input type="text" class="form-control" name="name" value="{{$client->name}}" placeholder="Name" required>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control" name="email" value="{{$client->email}}" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="role" value="{{$client->role}}" placeholder="Role">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="address" value="{{$client->address}}" placeholder="Address">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="phoneNumber" value="{{$client->phoneNumber}}" placeholder="Phone Number">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="id" value="{{$client->id}}" placeholder="id">
    </div>
    <button type="submit" class="btn btn-primary">Edit Client</button>
    <a href="{{ route('admin.show-clients') }}" class="btn btn-secondary">Clients list</a>
</form>
@endsection