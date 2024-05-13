@extends('layouts.app')

@section('content')
@include('layouts.modals.edit-repair-modal')
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
                                        <th scope="col">Additional Charges</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Repair Description</th>
                                        <th scope="col">Mechanic Name</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach($invoices as $invoice)
                                        <tr>
                                        <td class="d-none">{{ $invoice->id }}</td>
                                        <td>{{ $invoice->additional_charges }}DH</td>
                                        <td>{{ $invoice->total_amount }} DH</td>
                                        <td>{{ $invoice->repair_description }}</td>
                                        <td>{{ $invoice->mechanic_name }}</td>
                                        <td>{{ $invoice->client_name }}</td>
                                        <td>
                                             <a href="{{route('client.pdf-invoice', ['id' => $invoice->id])}}" 
                                                 class="btn btn-success btn-sm" title="Download Invoice" style="margin-left: 5px;" target="_blank" download="{{ $invoice->repair_id }}">
                                                <i class="bi bi-filetype-pdf"></i></a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    
                                        @if(count($invoices) == 0)
                                        <tr>
                                            <td colspan="7">No invoices found</td>
                                        </tr>
                                        @endif

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
    </section>
</div>



@endsection