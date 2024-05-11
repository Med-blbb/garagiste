<!-- resources/views/admin/users.blade.php -->
@extends('layouts.app')
@section('content')
@include('layouts.modals.show-user-modal')
@include('layouts.modals.edit-user-modal')
@include('layouts.modals.add-user-modal')
@include('layouts.modals.import-users')


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
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">
                                            <a href="{{ route('admin.users.export') }}" class="text-white" style="text-decoration: none">
                                                <button class="btn btn-primary btn-sm">Export</button>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importModal">
                                                Import
                                            </button>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm show-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-address="{{ $user->address }}" data-phonenumber="{{ $user->phoneNumber }}"  data-toggle="modal" data-target="#viewUserModal">Show</button>
                                            <button class="btn btn-primary btn-sm edit-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-address="{{ $user->address }}" data-phonenumber="{{ $user->phoneNumber }}"  data-toggle="modal" data-target="#editUserModal">Edit</button>
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
        {{ $users->links() }}
        </div>
        <!-- /.container-fluid -->
    </section>
</div>

<!-- Pagination Links -->


<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.edit-user').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role')
            var address = $(this).data('address');
            var phoneNumber = $(this).data('phonenumber');
            

            // Populate modal fields with current user details
            $('#id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_role').val(role);
            $('#edit_user_id').val(id);
            $('#edit_address').val(address);
            $('#edit_phoneNumber').val(phoneNumber);
        });
        $(document).ready(function() {
    $('.show-user').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var role = $(this).data('role');
        var address = $(this).data('address');
        var phoneNumber = $(this).data('phonenumber');

        // Populate modal fields with current user details for viewing
        $('#user_name').text(name);
        $('#user_email').text(email);
        $('#user_role').text(role);
        $('#user_id').text(id);
        $('#user_address').text(address);
        $('#user_phoneNumber').text(phoneNumber);
    });
});

        $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    });
</script>
@endsection