@include('layouts.main-headerbar')
@include('layouts.head')
@include('layouts.main-sidebar')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Vehicles</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.vehicles.add') }}" class="btn btn-primary">Add Vehicle</a>
                    </div>

                    @if ($vehicles->isEmpty())
                    <p>No vehicles found.</p>
                    @else
                    <ul>
                        @foreach ($vehicles as $vehicle)
                        <li>
                            <strong>{{ $vehicle->make }} - {{ $vehicle->model }} - {{ $vehicle->registration }}</strong>

                            <br>

                            @if ($vehicle->images)
                            @foreach (json_decode($vehicle->images) as $image)
                            <img src="{{ asset('storage/images/' . $image) }}" alt="{{ $vehicle->make }} - {{ $vehicle->model }} - {{ $vehicle->registration }}" width="200">
                            @endforeach
                            @endif
                            <form action="{{ route('admin.vehicles.delete', $vehicle) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </li>
                        <!-- Add more vehicle details as needed -->
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>