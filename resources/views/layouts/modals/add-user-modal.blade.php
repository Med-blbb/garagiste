<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addUserForm" action="{{ route('admin.users.add') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Add form fields for user details -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group form-floating mb-3">
                    <label for="floatingRole">Role</label>
                    <select class="form-control" name="role" id="floatingRole" required autofocus>
                        <option value="">Select Role</option>
                        <option value="mechanic">Mechanician</option>
                        <option value="client">Client</option>
                    </select>
                    
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class ="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" class="form-control" name="phoneNumber" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                    <div class="mb-3">
                        <label for="role">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password 8 characters" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
