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
                            <a href="{{ route('admin.add-invoice') }}" class="text-white mb-3 btn btn-primary" style="text-decoration: none">Add Invoice</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Additional Charges</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Total Amount</th> <!-- Added -->
                                        <th scope="col">Repair Description</th>
                                        <th scope="col">Repair ID</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->additional_charges }}</td>
                                        <td>{{ $invoice->amount }}</td>
                                        <td>{{ $invoice->total_amount }}</td> <!-- Modified -->
                                        <td>{{ $invoice->repair_description }}</td>
                                        <td>{{ $invoice->repair_id }}</td>
                                        <td>{{ $invoice->client_name }}</td>
                                        <td>
                                            <a href="{{route('admin.edit-invoice', ['id' => $invoice->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-invoice', ['id' => $invoice->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Remove Invoice" >
                                                    <i class="bi bi-trash h5"></i>
                                                </button>
                                            </form>
                                            <a href="{{route('admin.pdf-invoice', ['id' => $invoice->id])}}" 
                                                class="btn btn-success btn-sm" title="Download Invoice" style="margin-left: 5px;" target="_blank" download="{{ $invoice->repair_id }}">
                                                <i class="bi bi-filetype-pdf"></i></a>
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

            {{ $invoices->links() }}

        </div>

    </section>
</div>
@endsection
