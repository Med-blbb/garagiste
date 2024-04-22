@extends('layouts.app')
@section('content')
@include('layouts.show-user-modal')
@include('layouts.edit-user-modal')


<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.add-client') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Client</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Vehicule</th>
                                        <th scope="col">Actions</th>
                                        <!-- <th scope="col"><a href="{{ route('admin.users.export') }}" class="text-white" style="text-decoration: none"><button class="btn btn-primary btn-sm">Export</button></a></th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->role }}</td>
                                        <td>{{ $client->phoneNumber }}</td>
                                        <td>{{ $client->address }}</td>
                                        <td>
                                            @foreach($vehicle->where('user_id', $client->id) as $userVehicle)
                                            <p>{{ $userVehicle->make }} - {{ $userVehicle->model }} - {{ $userVehicle->registration }}</p>
                                            @endforeach
                                            @if(count($vehicle->where('user_id', $client->id)) == 0)
                                            <p>No vehicle</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.edit-client', ['id' => $client->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-client', ['id' => $client->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Remove Client" >
                                                <i class="bi bi-trash h5"></i>
                                            </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <div class="pagination justify-content-center">
            <style>
                .pagination .page-link {
                    font-size: 2px;
                    /* Adjust the font size as needed */
                }
            </style>

        </div>

    </section>
</div>
@endsection