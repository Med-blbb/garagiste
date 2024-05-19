@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-10/12 lg:w-8/12 xl:w-6/12">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-6">All Vehicles</h1>
                <div class="mt-4">
                    <form action="{{ route('admin.vehicles.searchVehicle') }}" method="GET" class="flex">
                        <input class="form-input mr-2 w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-primary px-4 py-2 rounded-lg">Search</button>
                    </form>
                </div>

                <div class="mt-8">
                    <a href="{{ route('admin.vehicles.add') }}" class="btn btn-primary">Add Vehicle</a>
                </div>

                <div class="mt-8">
                    @if ($vehicles->isEmpty())
                    <p class="text-gray-500">No vehicles found.</p>
                    @else
                    <ul class="mt-4">
                        @foreach ($vehicles as $vehicle)
                        <li class="border-b border-gray-300 py-4">
                            <div>
                                <strong class="text-lg font-semibold">{{ $vehicle->make }} - {{ $vehicle->model }} - {{ $vehicle->registration }}</strong>
                                <div class="mt-2 text-gray-600">Owner: {{ $vehicle->name }}</div>
                                <div class="mt-2 text-gray-600">ID: {{ $vehicle->id }}</div>

                                <div class="mt-4 overflow-x-auto">
                                    <div class="flex">
                                        @if ($vehicle->images)
                                        @foreach (json_decode($vehicle->images) as $image)
                                        <img src="{{ asset('storage/images/' . $image) }}" alt="{{ $vehicle->make }} - {{ $vehicle->model }} - {{ $vehicle->registration }}" class="max-w-xs rounded-lg shadow-md mr-4">
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.vehicles.delete', $vehicle->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-4">Delete</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-6">
                        {{ $vehicles->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
