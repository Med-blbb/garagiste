@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Make</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Fuel Type</th>
                                        <th scope='col'>Registration</th> 
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->id }}</td>
                                        <td>{{ $vehicle->make }}</td>
                                        <td>{{$vehicle->model}}</td>
                                        <td>{{ $vehicle->fuel_type }}</td>
                                        <td>{{ $vehicle->registration }}</td>
                                        <td>
                                            <a href="{{route('mechanic.show.vehicle',['id'=>$vehicle->id])}}" data-id="{{$vehicle->id}}" data-images="{{ $vehicle->images }}" class="btn btn-success btn-sm">Show</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('.show-vehicle').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var make = $(this).data('make');
        var images = $(this).data('images');

        // Populate modal fields with current user details for viewing
        $('#vehicle_id').text(id);
        $('#vehicle_make').text(make);
        $('#vehicle_images').text(images);
    });
    })
</script>
@endsection
