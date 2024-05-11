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
                            <a href="{{ route('admin.add-parts') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Spair Parts</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Part Name</th>
                                        <th scope="col">Part Reference</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach($spairParts as $part)
                                        <tr>
                                        <td>{{ $part->id }}</td>
                                        <td>{{ $part->part_name }}</td>
                                        <td>{{ $part->part_reference }}</td>
                                        <td>{{ $part->supplier }}</td>
                                        <td>{{ $part->price }} DH</td>
                                        <td>
                                            <a href="{{route('admin.edit-parts', ['id' => $part->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-parts', ['id' => $part->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this spair part?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Remove Spair Part" >
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

            {{ $spairParts->links() }}

        </div>

    </section>
</div>



@endsection