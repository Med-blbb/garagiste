<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function showAllUsers()
    {
        // Fetch all users
        $users = User::all();

        // Pass users data to the view
        return view('admin.users', compact('users'));
    }
    public function showAddUserForm() {
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
        return redirect()->route('admin.users.add')->with('success', 'User added successfully');
    }
}
