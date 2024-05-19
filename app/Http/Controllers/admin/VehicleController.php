<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class VehicleController extends Controller
{
    public function index()
    {
        // Fetch all vehicles
        $vehicles = db::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.id')
            ->simplePaginate(2);
            
        // Pass vehicles data to the view
        return view('admin.vehicle.show-vehicle', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicle.add-vehicle');
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


    public function destroy(Vehicle $vehicle)
    {
        $repair = Repair::where('vehicle_id', $vehicle->id)->first();
        if ($repair) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $repair->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        // Delete the vehicle
        $vehicle->delete();

        // Flash success message to session
        session()->flash('success', 'Vehicle deleted successfully.');

        // Redirect back to the previous page
        return redirect()->back();
    }


    public function searchVehicle()
    {
        $vehicles = db::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.id')
            ->where('users.name', 'like', '%' . request('search') . '%')
            ->orwhere('vehicles.model', 'like', '%' . request('search') . '%')
            ->orwhere('vehicles.fuel_type', 'like', '%' . request('search') . '%')
            ->orwhere('vehicles.registration', 'like', '%' . request('search') . '%')
            ->orwhere('vehicles.make', 'like', '%' . request('search') . '%')
            ->select('vehicles.*', 'users.name')
            ->simplePaginate(5);

        return view('admin.vehicle.show-vehicle', compact('vehicles'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function getOwner(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if ($user) {
            return response()->json(['name' => $user->name]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    public function searchUser(Request $request)
    {
        $userName = $request->input('user_name');

        // Perform the search query
        $users = User::where('name', 'like', '%' . $userName . '%')->get(['id', 'name']);

        return response()->json($users);
    }
}

