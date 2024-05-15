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

<h1 class="container col-md-6 mx-auto mt-5">Add Spair Part</h1>
<div class="container col-md-6 mx-auto mt-5">
<form class="form-group" action="{{ route('admin.add-parts') }}" method="post">
    @csrf
    <div class="modal-body">
        <!-- Add form fields for user details -->
        <div class="form-group">
            <label for="Part name">Part Name</label>
            <input type="text" class="form-control" id="part_name" name="part_name" required>
        </div>
        <div class="form-group">
            <label for="Part Reference">Part Reference</label>
            <input type="text" class="form-control" id="part_reference" name="part_reference" required>
        </div>
        <div class="form-group form-floating mb-3">
        <label for="supplier">Supplier</label>
        <input type="text" class="form-control" name="supplier" id="supplier" required >
        </div>
        <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" name="quantity" id="quantity" required>
        </div>
        <div class="form-group">
        <label for="repair_id">Repair ID</label>
        <input type="text" class="form-control" name="repair_id" id="repair_id" required>
        </div>
        <div class ="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" required>
        </div>
    </div>
    
    
        <a href="{{ route('admin.show-parts') }}" class="btn btn-secondary">Spair Parts list</a>
        <button type="submit" class="btn btn-primary">Add Spair Part</button>
    </div>
</form>
</div>
@endsection