<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SpairPart;

class SpairPartController extends Controller
{
    public function index()
    {
        $spairParts = SpairPart::all();
        return view('admin.spare_parts.index', compact('spareParts'));
    }

    public function create()
    {
        return view('admin.spare_parts.create');
    }

    public function store(Request $request)
    {
        // Validation

        $sparePart = new SpairPart ();
        $sparePart->partName = $request->input('partName');
        $sparePart->partReference = $request->input('partReference');
        $sparePart->supplier = $request->input('supplier');
        $sparePart->price = $request->input('price');
        $sparePart->save();

        return redirect()->route('spare_parts.index')->with('success', 'Spare part created successfully.');
    }

    public function edit($id)
    {
        $sparePart = SpairPart::findOrFail($id);
        return view('admin.spare_parts.edit', compact('sparePart'));
    }

    public function update(Request $request, $id)
    {
        // Validation

        $sparePart = SpairPart::findOrFail($id);
        $sparePart->partName = $request->input('partName');
        $sparePart->partReference = $request->input('partReference');
        $sparePart->supplier = $request->input('supplier');
        $sparePart->price = $request->input('price');
        $sparePart->save();

        return redirect()->route('spare_parts.index')->with('success', 'Spare part updated successfully.');
    }

    public function destroy($id)
    {
        $sparePart = SpairPart::findOrFail($id);
        $sparePart->delete();

        return redirect()->route('spare_parts.index')->with('success', 'Spare part deleted successfully.');
    }
}
