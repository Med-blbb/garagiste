<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        // Fetch all clients
        $clients = User::where('role', 'client')->simplePaginate(5);
        

        //Vehicule of clients
        $vehicle = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email')
        ->simplePaginate(5);
        
        return view('admin.client.show-clients', compact(['clients', 'vehicle']));
    }
    public function create()
    {
        return view('admin.client.add-client');
    }
    public function edit($id)
    {
        $client = User::findOrFail($id);
        return view('admin.client.edit-client', compact('client'));
    }
    public function update(Request $request)
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
    public function destroy($id)
    {
        $client = User::find($id);
        if(!$client){
            return redirect()->back()->whith('error','Client not found');
        }

        // $repair = Repair::where('client_id','=',$id);
        // if($repair){
        //     $repair->delete();
        // }
        $vehicle = Vehicle::where('user_id','=',$id);
        if($vehicle){
            $vehicle->delete();
        }
        
        $client->delete();
        return redirect()->back()->with('success',"Client deleted successfully");
    }

   

    
}
