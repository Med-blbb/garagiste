@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center">
                <div class="card-header" style="background-color: #3498db; color: #fff; font-size: 20px;">{{ Auth::user()->name }}'s Vehicles</div>

                <div class="card-body">
                    @if ($vehicles->isEmpty())
                    <p class="no-vehicles-msg">No vehicles found.</p>
                    @else
                    @foreach ($vehicles as $vehicle)
                    <div class="vehicle-card mb-4">
                        @if ($vehicle->images)
                        <div id="carousel{{ $vehicle->id }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach (json_decode($vehicle->images) as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/images/' . $image) }}" class="d-block w-100" alt="..." style="max-width: 800px; height: auto;">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel{{ $vehicle->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel{{ $vehicle->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        @endif
                        <div class="card-body text-left">
                            <h4 class="card-title vehicle-make mb-3" style="font-size: 24px; font-weight: bold;">{{ $vehicle->make }} - {{ $vehicle->model }}</h4>
                            <p class="card-text" style="font-size: 16px;"><strong>Registration:</strong> {{ $vehicle->registration }}</p>
                            <p class="card-text" style="font-size: 16px;"><strong>Owner:</strong> {{ $vehicle->name }}</p>
                            <p class="card-text" style="font-size: 16px;"><strong>Phone:</strong> {{ $vehicle->phoneNumber }}</p>
                            <p class="card-text" style="font-size: 16px;"><strong>Email:</strong> {{ $vehicle->email }}</p>
                        </div>
                        {{-- <form action="{{ route('admin.vehicles.delete', $vehicle) }}" method="post" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .no-vehicles-msg {
        font-style: italic;
        margin-top: 20px;
    }

    .vehicle-card {
        border: none;
        transition: transform 0.3s;
    }

    .vehicle-card:hover {
        transform: translateY(-5px);
    }

    .vehicle-make {
        color: #333; /* Change color of the vehicle make */
    }
</style>
@endsection
