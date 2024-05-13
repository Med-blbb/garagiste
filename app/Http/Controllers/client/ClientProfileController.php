<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientProfileController extends Controller
{
    public function dashboard()
    {
        $vehicle = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email')
        ->simplePaginate(5);
        $repair = DB::table('repairs')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->where('users.id', '=', auth()->user()->id)
        ->select('repairs.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email', 'users.address', 'users.phoneNumber')
        ->simplePaginate(5);
        return view('client.dashboard', compact(['vehicle', 'repair']));
    }
    public function vehicle()
    {
        $vehicles = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email', 'users.address', 'users.phoneNumber')
        ->simplePaginate(5);
        return view('client.vehicles', compact('vehicles'));
    }
    public function repair()
    {
        $repairs = DB::table('repairs')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users', 'repairs.mechanic_id', '=', 'users.id')
        
        ->select('repairs.*', 'vehicles.make', 'vehicles.model', 'users.name as client_name', 'users.email', 'users.address', 'users.phoneNumber')
        ->simplePaginate(5);
        return view('client.repairs', compact('repairs'));
    }
    public function updateClientNote(Request $request, $id)
{
    $repair = Repair::find($id);
    if(!$repair){
        return response()->json(['error' => 'Repair not found.'], 404);
    }
    
    $request->validate([
        'clientNote' => 'required|string', // Change to clientNote to match the form data
    ]);

    $repair->client_notes = $request->clientNote; // Change to clientNote to match the form data
    $repair->save();
    return response()->json(['success' => 'Client note updated successfully.']);
}

}
