<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Client;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', ['users' => User::all(), 'vehicles' => Vehicle::all()]);
    }
    public function showAllUsers()
    {
        // Fetch all users
        $users = User::simplepaginate(5);

        // Pass users data to the view
        return view('admin.users', compact('users'));
    }
    public function showAddUserForm()
    {
        return view('admin.add-user');
    }
    public function perform(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,editor,user', // Ensure valid role values
        ]);
        // Validate and create user...
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => ($validatedData['role'] === 'admin'),
            'is_mechanic' => ($validatedData['role'] === 'editor'), // Assuming 'editor' represents mechanic
            'is_client' => ($validatedData['role'] === 'user'),
        ]);

        // Check if user role is 'admin'
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');  // Redirect to admin dashboard route
        } else {
            return redirect()->route('user.dashboard');  // Redirect to user dashboard route (if different)
        }
    }
    public function searchUser(Request $request)
    {
        $users = User::where(
            'name',
            'like',
            '%' . request('search') . '%'
        )
            ->orwhere('name', 'like', '%' . request('search') . '%')
            ->orwhere('email', 'like', '%' . request('search') . '%')
            ->orwhere('role', 'like', '%' . request('search') . '%')
            ->simplePaginate(5);

        return view('admin.users', compact('users'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function addUser(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user instance
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect back to the admin dashboard
        return redirect()->route('admin.users')->with('success', 'User added successfully');
    }
    public function editUser($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Return the view with the user data
        return view('admin.users', ['user' => $user]); // Pass $user variable to the view
    }


    public function updateUser(Request $request)
    {
        // Check if the user exists
        // if (!$user) {
        //     return redirect()->back()->with('error', 'User not found.');
        // }

        $user = User::find($request->id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email =  $request->email;
        $user->role =   $request->role;
        $user->is_admin = $request->input('is_admin');
        $user->is_client =$request->input('is_client');
        $user->is_mechanic = $request->input('is_mechanic');
        $user->save();

        // Update the user data
        // $user->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User updated successfully.');
    }


    public function removeUser($id)
    {
        // Find the user by ID and delete it
        $user = User::find($id);
        $user->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    public function showAllVehicles()
    {
        // Fetch all vehicles
        $vehicles = Vehicle::latest()->simplepaginate(2);

        // Pass vehicles data to the view
        return view('admin.show-vehicle', compact('vehicles'));
    }

    public function showAddVehicleForm()
    {
        return view('admin.add-vehicle');
    }



    public function store(Request $request)
{
    $request->validate([
        'make' => 'required|string',
        'model' => 'required|string',
        'fuel_type' => 'required|string',
        'registration' => 'required|string|unique:vehicles,registration',
        'client_id' => 'required|numeric',
        'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $client = Client::find($request->client_id);

    if (!$client) {
        return redirect()->route('admin.add-client')->with('error', 'Client not found. Please add the client first.');
    }

    $vehicle = new Vehicle();
    $vehicle->make = $request->make;
    $vehicle->model = $request->model;
    $vehicle->fuel_type = $request->fuel_type;
    $vehicle->registration = $request->registration;
    $vehicle->client_id = $request->client_id;
    $vehicle->save();

    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $name = Str::random(30) . time();
            $imageName = $name . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/images'), $imageName);
            $images[] = $imageName;
        }
        $vehicle->images = json_encode($images);
        $vehicle->save();
    }

    return redirect()->route('admin.vehicles')->with('success', 'Vehicle created successfully');
}


    public function deleteVehicle(Request $request, Vehicle $vehicle)
    {
        // Delete the vehicle
        $vehicle->delete();

        // Flash success message to session
        Session::flash('success', 'Vehicle deleted successfully.');

        // Redirect back to the previous page
        return redirect()->back();
    }
    public function searchVehicle()
    {
        $vehicles = Vehicle::where(
            'model',
            'like',
            '%' . request('search') . '%'
        )
            ->orwhere('fuel_type', 'like', '%' . request('search') . '%')
            ->orwhere('registration', 'like', '%' . request('search') . '%')
            ->orwhere('make', 'like', '%' . request('search') . '%')
            ->simplePaginate(5);

        return view('admin.show-vehicle', compact('vehicles'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return back();
    }
}
