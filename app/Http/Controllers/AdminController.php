<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Client;
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
        return view('admin.dashboard', ['users' => User::all(), 'clients' => $clients, 'vehicles' => Vehicle::all(), 'mechanics' => $mechanics]);
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
        
        $vehicle = Vehicle::where('user_id', $id)->first();
        if ($vehicle) {
            $vehicle->delete();
        }
      

        $user->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    public function showClient()
    {
        // Fetch all clients
        $clients = User::where('role', 'client')->get();
        

        //Vehicule of clients
        $vehicle = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email')
        ->get();
        
        return view('admin.show-clients', compact(['clients', 'vehicle']));
    }
    public function showAllVehicles()
    {
        // Fetch all vehicles
        $vehicles = Vehicle::latest()
                            ->join('users', 'vehicles.user_id', '=', 'users.id')
                            ->select('vehicles.*','users.name', 'users.email')
                            ->simplepaginate(2);

        
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
        'user_id' => 'required|numeric',
        'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

   
    $vehicle = new Vehicle();
    $vehicle->make = $request->make;
    $vehicle->model = $request->model;
    $vehicle->fuel_type = $request->fuel_type;
    $vehicle->registration = $request->registration;
    $vehicle->user_id = $request->user_id;
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
    
    public function showAddClientForm()
    {
        return view('admin.add-client');
    }
    public function editClient($id)
    {
        $client = User::findOrFail($id);
        return view('admin.edit-client', compact('client'));
    }
    public function updateClient(Request $request)
    {
        $client = User::find($request->id);
        if (!$client){
            return redirect()->back()->with('error', 'Client not found.');
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
        ]);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->role = $request->role;
        $client->address = $request->address;
        $client->phoneNumber = $request->phoneNumber;
        $client->save();
        return redirect()->back()->with('success', 'Client updated successfully.');
    }
    public function deleteClient($id)
    {
        $client = User::find($id);
        if(!$client){
            return redirect()->back()->whith('error','Client not found');
        }
        $vehicle = Vehicle::where('user_id','=',$id);
        if($vehicle){
            $vehicle->delete();
        }
        $client->delete();
        return redirect()->back()->with('success',"Client deleted successfully");
    }
    public function showAddMechanicForm()
    {
        return view('admin.add-mechanic');
    }
    public function addMechanic(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
        ]);
        $mechanic = new User();
        $mechanic->name = $request->name;
        $mechanic->email = $request->email;
        $mechanic->role = $request->role;
        $mechanic->address = $request->address;
        $mechanic->phoneNumber = $request->phoneNumber;
        $mechanic->save();
        return redirect()->back()->with('success', 'Mechanic added successfully.');
    }
    public function showAllMechanics()
    {
        $mechanics = User::where('role', 'mechanic')->get();
        return view('admin.show-mechanics', compact('mechanics'));
    }
    
}
