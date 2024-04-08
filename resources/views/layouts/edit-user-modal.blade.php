<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm" action="{{ route('admin.users.update','$user->id') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <!-- Add form fields for editing user details -->
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_role">Role</label>
                        <input type="text" class="form-control" id="edit_role" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_is_admin">Is Admin</label>
                        <input type="checkbox" class="form-control" id="edit_is_admin" name="is_admin" >
                    </div>
                    <div class="form-group">
                        <label for="edit_is_user">Is Client</label>
                        <input type="checkbox" class="form-control" id="edit_is_client" name="is_client" >
                    </div>
                    <div class="form-group">
                        <label for="edit_is_mechanic">Is Mechanician</label>
                        <input type="checkbox" class="form-control" id="edit_is_mechanic" name="is_mechanic" >
                    </div>
                    <!-- Include user ID hidden input -->
                    <input type="hidden" id="edit_user_id" name="user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>