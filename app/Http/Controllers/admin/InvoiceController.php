<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SpairPart;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::simplePaginate(10);
        
        // Loop through each invoice
        foreach ($invoices as $invoice) {
            // Find the associated repair
            $repair = Repair::find($invoice->repair_id);
            
            $invoice->repair_description = $repair ? $repair->description : null;
        }
    
        return view('admin.invoice.show-invoices', compact('invoices'));
    }
    




    public function create()
    {
        return view('admin.invoice.add-invoices');
    }

    public function store(Request $request)
{
    // Validation
    $request->validate([
        'repair_id' => 'required',
        'additional_charges' => 'required|numeric',
        'amount' => 'required|numeric',
        'client_id' => 'required',
    ]);

    // Create a new invoice instance
    $invoice = new Invoice();

    // Assign input values to the invoice attributes
    $invoice->repair_id = $request->input('repair_id');
    $invoice->additional_charges = $request->input('additional_charges');
    $invoice->amount = $request->input('amount'); // Assuming amount represents repair cost

    // Calculate the total amount including additional charges and spare parts cost
    $totalAmount = $invoice->amount + $invoice->additional_charges;

    // Fetch spare parts associated with the repair
    $spareParts = SpairPart::where('repair_id', $invoice->repair_id)->get();

    // Calculate total amount based on spare parts quantity and price
    foreach ($spareParts as $sparePart) {
        $totalAmount += $sparePart->quantity * $sparePart->price;
    }

    // Assign the total amount to the invoice
    $invoice->total_amount = $totalAmount;
    $invoice->client_id = $request->input('client_id');
    
    // Save the invoice
    $invoice->save();

    // Attach spare parts to the invoice
    foreach ($spareParts as $sparePart) {
        $invoice->spareParts()->attach($sparePart->id);
    }

    return redirect()->route('admin.show-invoices')->with('success', 'Invoice created successfully.');
}


    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.edit-invoices', compact('invoice'));
    }

    public function update(Request $request, $id)
{
    // Validation
    $request->validate([
        'repair_id' => 'required',
        'additional_charges' => 'required|numeric',
        'total_amount' => 'required|numeric',
        'client_id' => 'required',
    ]);

    // Find the invoice by ID
    $invoice = Invoice::findOrFail($id);

    // Assign input values to the invoice attributes
    $invoice->repair_id = $request->input('repair_id');
    $invoice->client_id = $request->input('client_id');
    $invoice->additional_charges = $request->input('additional_charges');
    $invoice->amount = $request->input('amount');
    $totalAmount =$request->input('amount')+$request->input('additional_charges');
    $spareParts = SpairPart::where('repair_id', $invoice->repair_id)->get();
    
    foreach ($spareParts as $sparePart) {
        $totalPart = $sparePart->quantity * $sparePart->price;
    }
    $invoice->total_amount = $totalAmount + $totalPart;
    // Calculate the total amount including additional charges and spare parts cost
    
    

    // Save the updated invoice
    $invoice->save();

    return redirect()->route('admin.show-invoices')->with('success', 'Invoice updated successfully.');
}
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.show-invoices')->with('success', 'Invoice deleted successfully.');
    }
}
