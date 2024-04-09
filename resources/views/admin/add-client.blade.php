@include('layouts.main-headerbar')
@include('layouts.head')
@include('layouts.main-sidebar')


<form method="post" class="container col-md-6 mx-auto mt-5" action="{{ route('admin.add-client') }}">
    @csrf <!-- Add CSRF token for security -->
    <div class="mb-3">
        <input type="text" class="form-control" name="name" placeholder="Name" required>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" value="client" name="role" placeholder="Role">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="address" placeholder="Address">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="id" placeholder="id">
    </div>
    

    <button type="submit" class="btn btn-primary">Add Client</button>
</form>