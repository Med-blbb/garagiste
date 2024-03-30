<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        // Validation

        $vehicle = new Vehicle();
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->fuelType = $request->input('fuelType');
        $vehicle->registration = $request->input('registration');
        // Upload and store vehicle photos
        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        // Validation

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->fuelType = $request->input('fuelType');
        $vehicle->registration = $request->input('registration');
        // Update vehicle photos
        $vehicle->save();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        // Delete associated photos
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}

