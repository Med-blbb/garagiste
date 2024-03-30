<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', ['users' => User::all()]);
    }
    public function showAllUsers()
    {
        // Fetch all users
        $users = User::all();

        // Pass users data to the view
        return view('admin.users', compact('users'));
    }
    public function showAddUserForm()
    {
        return view('admin.add-user');
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


    public function updateUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|max:255',
        ]);

        // Update the user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

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
        $vehicles = Vehicle::all();

        // Pass vehicles data to the view
        return view('admin.show-vehicle', compact('vehicles'));
    }
    public function showAddVehicleForm()
    {
        return view('admin.add-vehicle');
    }



    public function addVehicle(Request $request)
    {
        // Validate the request
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'registration' => 'required|string',
            'photos' => 'nullable|array',
            'user_id' => 'required|exists:users,id',
        ]);

        // Check for duplicate registration numbers
        $existingVehicle = Vehicle::where('registration', $request->registration)->first();
        if ($existingVehicle) {
            return redirect()->back()->with('error', 'A vehicle with the same registration number already exists.');
        }

        // Handle file uploads
        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('vehicle_photos');
                $photos[] = asset('storage/' . $path);
            }
        }

        // Create a new vehicle instance
        $vehicle = new Vehicle;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->registration = $request->registration;
        $vehicle->photos = json_encode($photos); // Store photo URLs as JSON string
        $vehicle->client_id = $request->user_id;
        $vehicle->save();

        // Flash success message to session
        Session::flash('success', 'Vehicle added successfully.');

        // Redirect back to the previous page
        return redirect()->back();
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
}
