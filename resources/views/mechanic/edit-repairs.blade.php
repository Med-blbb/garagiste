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

<h1 class="container col-md-6 mx-auto mt-5">Edit Repair</h1>
<div class="container col-md-6 mx-auto mt-5">
    <form action="{{ route('mechanic.update-repair', ['id' => $repair->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $repair->description }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="Pending" {{ $repair->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In_progress" {{ $repair->status == 'In_progress' ? 'selected' : '' }}>In progress</option>
                <option value="Completed" {{ $repair->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $repair->start_date }}" readonly    >
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $repair->end_date }}">
        </div>
        <div class="form-group">
            <label for="mechanic_notes">Mechanic Notes</label>
            <input type="text" class="form-control" name="mechanic_notes" id="mechanic_notes" value="{{ $repair->mechanic_notes }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('mechanic.repairs') }}" class="btn btn-secondary" style="margin-left: 10px">Back</a>
    </form>
</div>
@endsection