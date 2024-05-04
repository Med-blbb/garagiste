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

<h1 class="container col-md-6 mx-auto mt-5">Add Invoice</h1>
<div class="container col-md-6 mx-auto mt-5">
<form class="form-group" action="{{ route('admin.add-invoice') }}" method="post">
    @csrf
    <div class="modal-body">
        <!-- Add form fields for user details -->
        <div class="form-group">
            <label for="Additional Charges">Additional Charges</label>
            <input type="text" class="form-control" id="additional_charges" name="additional_charges" required>
        </div>
        <div class="form-group">
            <label for="Total Amount">Total Amount</label>
            <input type="text" class="form-control" id="total_amount" name="total_amount" required>
        </div>
        <div class="form-group form-floating mb-3">
        <label for="repair_id">Repair ID</label>
        <input type="text" class="form-control" name="repair_id" id="repair_id" required >
        
        
    </div>    
        <a href="{{ route('admin.show-invoices') }}" class="btn btn-secondary">Invoices list</a>
        <button type="submit" class="btn btn-primary">Add Invoice</button>
    </div>
</form>
</div>
@endsection