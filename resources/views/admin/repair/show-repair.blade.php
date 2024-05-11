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
                                     @php
                                       $statusList = ['Pending', 'In_progress', 'Completed'];
                                    @endphp
                                    @foreach($repairs as $repair)
                                    <tr>
                                        <td class="repair-id">{{ $repair->id }}</td>
                                        <td>{{ $repair->description }}</td>
                                        <td>
                                            <select class="status form-control" name="status"> <!-- Change ID to class -->
                                                @foreach($statusList as $status)
                                                    <option value="{{ $status }}" {{ $repair->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        
                                        
                                        <td>{{ $repair->start_date }}</td>
                                        <td>{{ $repair->end_date }}</td>
                                        <td>{{ $repair->mechanic_notes }}</td>
                                        <td>{{ $repair->client_notes }}</td>
                                        <td>{{ $repair->mechanic_id }}</td>
                                        <td>{{ $repair->vehicle_id }}</td>
                                        
                                        <td>
                                            <a href="{{route('admin.update-repair', ['id' => $repair->id])}}" data-id="{{ $repair->id }}" data-status="{{ $repair->status }}" class="btn btn-primary edit-repair btn-sm">Edit</a>
                                            <form action="{{route('admin.delete-repair', ['id' => $repair->id])}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this repair?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Remove Repair" >
                                                <i class="bi bi-trash h5"></i>
                                            </button>
                                            </form>
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
                
                            {{ $repairs->links() }}
                
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
    $('.status').on('change', function(){
        var selectedValue = $(this).val();
        var repairId = $(this).closest('tr').find('.repair-id').text(); // Retrieve repair ID from the closest row
        var token = $('meta[name="csrf-token"]').attr('content');
        console.log(repairId + ' ' + selectedValue);
        $.ajax({
            type: 'PUT',
            url: '/admin/edit/repair/status/' + repairId,
            data: { status: selectedValue },
            headers: {'X-CSRF-TOKEN': token},
            success: function(response){
                console.log('Status updated successfully.');
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while updating status:', error);
            }
        });
    });
});

</script>


@endsection