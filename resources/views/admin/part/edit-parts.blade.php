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
<form method="post" class="container col-md-6 mx-auto mt-5" action="{{ route('admin.edit-parts', $sparePart) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <input type="text" class="form-control" name="part_name" value="{{$sparePart->part_name}}" placeholder="Part Name" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="part_reference" value="{{$sparePart->part_reference}}" placeholder="Part Reference" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="supplier" value="{{$sparePart->supplier}}" placeholder="Supplier">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="price" value="{{$sparePart->price}}" placeholder="Price">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="id" value="{{$sparePart->id}}" placeholder="id">
    </div>
    <button type="submit" class="btn btn-primary">Edit Spair Part</button>
    <a href="{{ route('admin.show-parts') }}" class="btn btn-secondary">Spair Parts list</a>
</form>
@endsection