@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.add-mechanic') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Mechanic</a>
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
                                    @foreach($mechanics as $mechanic)
                                    <tr>
                                        <td>{{ $mechanic->name }}</td>
                                        <td>{{ $mechanic->email }}</td>
                                        <td>{{ $mechanic->role }}</td>
                                        <td>{{ $mechanic->phoneNumber }}</td>
                                        <td>{{ $mechanic->address }}</td>
                                        <td>
                                            @foreach($vehicles as $vehicle)
                                                @if($mechanic->id == $vehicle->mechanic_id)
                                                    {{ $vehicle->make }} {{ $vehicle->model }} {{$vehicle->registration}} <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit-mechanic', ['id' => $mechanic->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-mechanic', ['id' => $mechanic->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Remove Mechanic" >
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
            {{ $vehicles->links() }}
            </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
