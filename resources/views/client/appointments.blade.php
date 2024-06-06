@extends('layouts.app')

@section('content')
@include('layouts.modals.edit-repair-modal')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
    <div class="container mx-auto mt-5 w-50 text-center mb-5">
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class=" w-50 text-center mb-5">
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class=" w-50 text-center mb-5">
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('client.add-appointment') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Appointment</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th> 
                                        <th scope="col">time</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>{{ $appointment->type }}</td>
                                        <td>{{ $appointment->date }}</td> <!-- Modified -->
                                        <td>{{ $appointment->time }}</td>
                                        <td>{{ $appointment->name}}</td>
                                        <td>
                                            <a href="{{route('client.edit-appointment', ['id' => $appointment->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('client.delete-appointment', ['id' => $appointment->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Remove appointment" >
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

            {{ $appointments->links() }}

        </div>

    </section>
</div>
@endsection
