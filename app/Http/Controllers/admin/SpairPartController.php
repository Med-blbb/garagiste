<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SpairPart;

class SpairPartController extends Controller
{
    public function index()
    {
        $spairParts = SpairPart::simplepaginate(7);
        return view('admin.part.show-parts', compact('spairParts'));
    }

    public function create()
    {
        return view('admin.part.add-parts');
    }

    public function store(Request $request)
    {
        // Validation

        $request->validate([
            'part_name' => 'required',
            'part_reference' => 'required',
            'supplier' => 'required',
            'price' => 'required|numeric',
        ]);

        $sparePart = new SpairPart ();
        $sparePart->part_name = $request->input('part_name');
        $sparePart->part_reference = $request->input('part_reference');
        $sparePart->supplier = $request->input('supplier');
        $sparePart->price = $request->input('price');
        $sparePart->quantity = $request->input('quantity');
        $sparePart->repair_id = $request->input('repair_id');
        $sparePart->save();

        return redirect()->route('admin.show-parts')->with('success', 'Spare part created successfully.');
    }

    public function edit($id)
    {
        $sparePart = SpairPart::findOrFail($id);
        return view('admin.part.edit-parts', compact('sparePart'));
    }

    public function update(Request $request, $id)
    {
        // Validation

        $request->validate([
            'part_name' => 'required',
            'part_reference' => 'required',
            'supplier' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'repair_id' => 'required',
        ]);

        $sparePart = SpairPart::findOrFail($id);
        $sparePart->part_name = $request->input('part_name');
        $sparePart->part_reference = $request->input('part_reference');
        $sparePart->supplier = $request->input('supplier');
        $sparePart->price = $request->input('price');
        $sparePart->quantity = $request->input('quantity');
        $sparePart->repair_id = $request->input('repair_id');
        $sparePart->save();

        return redirect()->route('admin.show-parts')->with('success', 'Spare part updated successfully.');
    }

    public function destroy($id)
    {
        $sparePart = SpairPart::findOrFail($id);
        $sparePart->delete();

        return redirect()->route('admin.show-parts')->with('success', 'Spare part deleted successfully.');
    }
}
