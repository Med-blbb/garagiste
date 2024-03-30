<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.users', ['users' => $users]);
    }
   
}

