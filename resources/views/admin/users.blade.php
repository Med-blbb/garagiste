<!-- resources/views/admin/users.blade.php -->
@include('layouts.main-headerbar')
@include('layouts.head')
@include('layouts.main-sidebar')
@include('layouts.show-user-modal')
@include('layouts.edit-user-modal')


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
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>
                    <div class="mb-3">
                        <label for="role">Password</label>
                        <input type="password" class="form-control" name="password" required>
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

<!-- Button trigger modal -->
<div class=" row justify-content-center mt-5">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUserModal">
            Add User
        </button>
    </div>
    <div class="col-md-2">
        <h3><a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a></h3>
    </div>
</div>
<!-- Include success and error messages -->
<div class="row justify-content-center mt-3">
    <form action="{{ route('admin.users.searchUser') }}" method="GET" class="form-inline">
        <input class="form-control " style="width: 450px;" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request()->input('search') }}">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>

<table class="table w-100 col-6 flex-end mt-3 mx-auto">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
            <th scope="col"><a href="{{ route('admin.users.export') }}" class="text-white" style="text-decoration: none"><button class="btn btn-primary btn-sm">Export</button></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <button class="btn btn-success btn-sm show-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-toggle="modal" data-target="#viewUserModal">Show</button>
                <button class="btn btn-primary btn-sm edit-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-toggle="modal" data-target="#editUserModal">Edit</button>
                <form action="{{ route('admin.users.remove', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Remove User" onclick="return confirm('Are you sure you want to delete this user?')">
                        <i class="bi bi-trash h5"></i>
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<!-- Pagination Links -->
<div class="pagination justify-content-center">
    <style>
        .pagination .page-link {
            font-size: 2px;
            /* Adjust the font size as needed */
        }
    </style>
    {{ $users->links() }}
</div>

<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.edit-user').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role')
            var is_admin = $(this).data('is_admin');
            var is_client = $(this).data('is_client');
            var is_mechanic = $(this).data('is_mechanic');

            // Populate modal fields with current user details
            $('#id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_role').val(role);
            $('#edit_user_id').val(id);
            $('#edit_is_admin').val($('#edit_is_admin').is(':checked') ? 0: 1);
            $('#edit_is_client').val($('#edit_is_client').is(':checked') ? 0: 1);
            $('#edit_is_mechanic').val($('#edit_is_mechanic').is(':checked') ? 0: 1);
        });
        $('.show-user').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role');

            // Populate modal fields with current user details for viewing
            $('#user_name').text(name);
            $('#user_email').text(email);
            $('#user_role').text(role);
            $('#user_id').text(id);
        });

    });
</script>