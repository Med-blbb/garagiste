<!-- Edit Repair Modal -->
<div class="modal fade" id="editRepairModal" tabindex="-1" aria-labelledby="editUserModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRepairModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm" action="{{ route('admin.edit-repair','$repair->id') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <!-- Add form fields for editing user details -->
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="edit_start_date">
                    </div>
                    <div class="form-group">
                        <label for="edit_end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="edit_end_date">
                    </div>
                    <div class="form-group">
                        <label for="edit_mechanic_notes">Mechanic Notes</label>
                        <input type="text" class="form-control" id="edit_mechanic_notes" name="mechanic_notes" >
                    </div>
                    <div class="form-group">
                        <label for="edit_client_notes">Client Notes</label>
                        <input type="text" class="form-control" id="edit_client_notes" name="client_notes" >
                    </div>
                    <div class="form-group">
                        <label for="edit_mechanic_id">Mechanic ID</label>
                        <input type="text" class="form-control" id="edit_mechanic_id" name="mechanic_id" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_vehicle_id">Vehicle ID</label>
                        <input type="text" class="form-control" id="edit_vehicle_id" name="vehicle_id" required>
                    </div>
                    <!-- Include user ID hidden input -->
                    <input type="hidden" id="edit_repair_id" name="repair_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Repair</button>
                </div>
            </form>
        </div>
    </div>
</div>