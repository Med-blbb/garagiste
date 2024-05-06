<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
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
            'total_amount' => 'required|numeric',
            'client_id' => 'required',
        ]);

        $invoice = new Invoice();
        $invoice->repair_id = $request->input('repair_id');
        $invoice->additional_charges = $request->input('additional_charges');
        // Calculate total amount based on repair cost and additional charges
        $invoice->total_amount = $request->input('total_amount');
        $invoice->client_id = $request->input('client_id');
        $invoice->save();

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

        $invoice = Invoice::findOrFail($id);
        $invoice->repair_id = $request->input('repair_id');
        $invoice->client_id = $request->input('client_id');
        $invoice->additional_charges = $request->input('additional_charges');
        // Calculate total amount based on repair cost and additional charges
        $invoice->total_amount = $request->input('total_amount');
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
