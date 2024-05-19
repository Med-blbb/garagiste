<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SpairPart;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $clients = User::where('role', 'client');
        $mechanics = User::where('role', 'mechanic');
        $admins = User::where('role', 'admin');
        $repairs =Repair::all();
        $parts = SpairPart::all();
        $invoices = Invoice::all();
        $appointments = Appointment::all();
        return view('admin.dashboard', ['users' => User::all(), 'clients' => $clients, 'vehicles' => Vehicle::all(), 'mechanics' => $mechanics ,'admins' => $admins, 'repairs' => $repairs, 'parts' => $parts, 'invoices' => $invoices , 'appointments' => $appointments ]);
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
            'role' => 'required|string|in:admin,mechanic,client', // Ensure valid role values
        ]);
        // Validate and create user...
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        
        
        if ($user->role=='admin') {
            return redirect()->route('admin.dashboard'); 
        } elseif ($user->role=='mechanic') {
            return redirect()->route('mechanic.dashboard');  
        } elseif ($user->role=='client') {
            return redirect()->route('client.dashboard');  
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
            'phoneNumber' => 'required|string|max:255',
        ]);

        // Create a new user instance
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phoneNumber = $request->phoneNumber;
        $user->save();

       
        

        // Redirect back to the admin dashboard
        return redirect()->back()->with('success', 'User added successfully');
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
        $user->address = $request->address;
        $user->phoneNumber = $request->phoneNumber;
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
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $vehicle = Vehicle::where('user_id', $id)->first();
        if ($vehicle) {
            $repair = Repair::where('vehicle_id', $vehicle->id)->get();
            if ($repair) {
                foreach ($repair as $rep) {
                    $invoices = Invoice::where('repair_id', $rep->id)->get();
                    if ($invoices) {
                        foreach ($invoices as $invoice) {
                            $invoice->delete();
                        }
                    }
                    $rep->delete();
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $vehicle->delete();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
        }

        $user->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User deleted successfully.');
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
