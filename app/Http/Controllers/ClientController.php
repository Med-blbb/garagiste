<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        // Validate the request

        $client = new Client();
        $client->firstName = $request->input('firstName');
        $client->lastName = $request->input('lastName');
        $client->address = $request->input('address');
        $client->phoneNumber = $request->input('phoneNumber');
        $client->email = $request->input('email');
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request

        $client = Client::findOrFail($id);
        $client->firstName = $request->input('firstName');
        $client->lastName = $request->input('lastName');
        $client->address = $request->input('address');
        $client->phoneNumber = $request->input('phoneNumber');
        $client->email = $request->input('email');
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
