<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MechanicController extends Controller
{
    public function create()
    {
        return view('admin.mechanic.add-mechanic');
    }
    public function store(Request $request)
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
    public function index()
    {
        $mechanics = User::where('role', 'mechanic')->simplepaginate(5);
        $vehicles = DB::table('repairs')
            ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
            ->join('users', 'repairs.mechanic_id', '=', 'users.id')
            ->select('repairs.*', 'vehicles.*')
            ->simplepaginate(5);

        return view('admin.mechanic.show-mechanics', compact(['mechanics', 'vehicles']));
    }
    public function edit($id)
    {
        $mechanic = User::findOrFail($id);
        return view('admin.mechanic.edit-mechanic', compact('mechanic'));
    }
    public function update(Request $request)
    {
        $mechanic = User::find($request->id);
        if (!$mechanic){
            return redirect()->back()->with('error', 'Mechanic not found.');
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
        ]);
        $mechanic->name = $request->name;
        $mechanic->email = $request->email;
        $mechanic->role = $request->role;
        $mechanic->address = $request->address;
        $mechanic->phoneNumber = $request->phoneNumber;
        $mechanic->save();
        return redirect()->back()->with('success', 'Mechanic updated successfully.');
    }
}
