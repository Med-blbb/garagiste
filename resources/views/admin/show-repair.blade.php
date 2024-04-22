@extends('layouts.app')

@section('content')
@include('layouts.modals.edit-repair-modal')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.add-repair') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Repairs</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Mechanic Notes</th>
                                        <th scope="col">Client Notes</th>
                                        <th scope="col">Mechanic ID</th>
                                        <th scope="col">Vehicle ID</th>
                                        <th scope="col">Actions</th>
                                        <!-- <th scope="col"><a href="{{ route('admin.users.export') }}" class="text-white" style="text-decoration: none"><button class="btn btn-primary btn-sm">Export</button></a></th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($repairs as $repair)
                                    <tr>
                                        <td>{{ $repair->id }}</td>
                                        <td>{{ $repair->description }}</td>
                                        <td>{{ $repair->status }}</td>
                                        <td>{{ $repair->start_date }}</td>
                                        <td>{{ $repair->end_date }}</td>
                                        <td>{{ $repair->mechanic_notes }}</td>
                                        <td>{{ $repair->client_notes }}</td>
                                        <td>{{ $repair->mechanic_id }}</td>
                                        <td>{{ $repair->vehicle_id }}</td>
                                        
                                        <td>
                                            {{-- <a href="{{route('admin.edit-client', ['id' => $client->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-client', ['id' => $client->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Remove Client" >
                                                <i class="bi bi-trash h5"></i>
                                            </button>
                                            </form> --}}
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