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
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Mechanic Notes</th>
                                        <th scope="col">Client Notes</th>
                                        <th scope="col">Mechanic Name</th>
                                        <th scope="col">Vehicle Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($repairs as $repair)
                                    <tr>
                                        <td class="repair-id d-none">{{ $repair->id }}</td>
                                        <td>{{ $repair->description }}</td>
                                        <td>{{ $repair->status }}</td>
                                        <td>{{ $repair->start_date }}</td>
                                        <td>{{ $repair->end_date ?? 'No End Date Set' }}</td>
                                        <td>{{ $repair->mechanic_notes ?? 'No Mechanic Notes Set' }}</td>
                                        <td>
                                            <span class="client-note">{{ $repair->client_notes ?? 'No Client Notes Set' }}</span>
                                            <button type="button" class="btn btn-primary btn-sm edit-note" data-toggle="modal" data-target="#editClientNoteModal" data-note="{{ $repair->client_notes }}" data-id="{{ $repair->id }}">Edit</button>
                                        </td>
                                        <td>{{ $repair->client_name }}</td>
                                        <td>{{ $repair->make }}</td>
                                        
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
    </section>
</div>

<!-- Edit Client Note Modal -->
<div class="modal fade" id="editClientNoteModal" tabindex="-1" role="dialog" aria-labelledby="editClientNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClientNoteModalLabel">Edit Client Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editClientNoteForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="clientNote">Client Note:</label>
                        <textarea class="form-control"  id="clientNote" name="clientNote"  rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
    $('.edit-note').click(function() {
        var note = $(this).data('note');
        var id = $(this).data('id');
        $('#editClientNoteForm textarea').val(note);
        $('#editClientNoteForm').attr('action', '/client/update/client/note/' + id);


    });

    $('#editClientNoteForm').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var token = $('meta[name="csrf-token"]').attr('content');
        var formData = form.serialize();
        $.ajax({
            type: 'PUT',
            url: url,
            data: formData,
            headers: {'X-CSRF-TOKEN': token},
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

@endsection