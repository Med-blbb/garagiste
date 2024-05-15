@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-header">{{ __('Repair Details') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.add-repair') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description (*)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" id="description" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status (*)') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" >
                                    <option class="status" value="Pending">Pending</option>
                                    <option class="status" value="In_progress">In Progress</option>
                                    <option class="status" value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date (*)') }}</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date (Optional)') }}</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="end_date" id="end_date" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mechanic_notes" class="col-md-4 col-form-label text-md-right">{{ __('Mechanic Notes (Optional)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mechanic_notes" id="mechanic_notes" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="client_notes" class="col-md-4 col-form-label text-md-right">{{ __('Client Notes (Optional)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client_notes" id="client_notes" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mechanic_id" class="col-md-4 col-form-label text-md-right">{{ __('Mechanic ID (*)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mechanic_id" id="mechanic_id" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_id" class="col-md-4 col-form-label text-md-right">{{ __('Vehicle ID (*)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle_id" id="vehicle_id" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Repair') }}
                                </button>
                                <a href="{{ route('admin.show-repair') }}" class="btn btn-secondary" style="text-decoration: none">List Repairs</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
