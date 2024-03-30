<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repair;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::all();
        return view('admin.repairs.index', compact('repairs'));
    }

    public function create()
    {
        return view('admin.repairs.create');
    }

    public function store(Request $request)
    {
        // Validation

        $repair = new Repair();
        $repair->description = $request->input('description');
        $repair->status = $request->input('status');
        // Set mechanic ID
        // Set vehicle ID
        $repair->save();

        return redirect()->route('repairs.index')->with('success', 'Repair created successfully.');
    }

    public function edit($id)
    {
        $repair = Repair::findOrFail($id);
        return view('admin.repairs.edit', compact('repair'));
    }

    public function update(Request $request, $id)
    {
        // Validation

        $repair = Repair::findOrFail($id);
        $repair->description = $request->input('description');
        $repair->status = $request->input('status');
        // Update mechanic ID if changed
        // Update vehicle ID if changed
        $repair->save();

        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully.');
    }

    public function destroy($id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully.');
    }
}
