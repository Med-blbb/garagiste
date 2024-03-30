@include('layouts.main-headerbar')
@include('layouts.head')
@include('layouts.main-sidebar')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Add Vehicle
                </div>
                <div class="mb-3">
                    <a href="{{ route('admin.vehicles') }}" class="btn btn-primary">Add Vehicle</a>
                </div>
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('admin.vehicles.add') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="make">Make</label>
                            <input type="text" class="form-control" id="make" name="make" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model" required>
                        </div>
                        <div class="form-group">
                            <label for="fuel_type">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" name="fuel_type" required>
                        </div>
                        <div class="form-group">
                            <label for="registration">Registration</label>
                            <input type="text" class="form-control" id="registration" name="registration" required>
                        </div>
                        <div class="form-group">
                            <label for="photos">Photos</label>
                            <input type="file" class="form-control-file" id="photos" name="photos[]" multiple accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="client_id" name="user_id" ">
                        </div>

                        <button type=" submit" class="btn btn-primary">Add Vehicle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>