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

<h1 class="container col-md-6 mx-auto mt-5">Edit Invoice</h1>
<form method="post" class="container col-md-6 mx-auto mt-5" action="{{ route('admin.edit-invoice', $invoice) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="additional_charges">Additional Charges</label>
        <input type="text" class="form-control" name="additional_charges" value="{{$invoice->additional_charges}}" placeholder="Additional Charges" required>
    </div>
    <div class="mb-3">
        <label for="amount">Amount</label>
        <input type="text" class="form-control" name="amount" value="{{$invoice->amount}}" placeholder="Amount" required>
    </div>
<div class="mb-3">
    <label for="total_amount">Total Amount</label>
    <input type="text" class="form-control" name="total_amount" value="{{$invoice->total_amount}}" placeholder="Total Amount" required readonly>
</div>
    <div class="mb-3">
        <label for="repair_id">Repair ID</label>
        <input type="text" class="form-control" name="repair_id" value="{{$invoice->repair_id}}" placeholder="Repair ID">
    </div>
    <div class="mb-3">
        <label for="client_id">Client ID</label>
        <input type="text" class="form-control" name="client_id" value="{{$invoice->client_id}}" placeholder="client_id">
    </div>
    <button type="submit" class="btn btn-primary">Edit Invoice</button>
    <a href="{{ route('admin.show-invoices') }}" class="btn btn-secondary">Invoices list</a>
</form>
@endsection