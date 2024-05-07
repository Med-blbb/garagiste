<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class VehicleController extends Controller
{
    public function index()
    {
        // Fetch all vehicles
        $vehicles = Vehicle::latest()
                            ->join('users', 'vehicles.user_id', '=', 'users.id')
                            ->select('vehicles.*','users.name', 'users.email')
                            ->simplepaginate(2);

        
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


    public function destroy(Request $request, Vehicle $vehicle)
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

        return view('admin.vehicle.show-vehicle', compact('vehicles'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    
}

