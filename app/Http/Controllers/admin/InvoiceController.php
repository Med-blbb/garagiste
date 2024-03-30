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
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request)
    {
        // Validation

        $invoice = new Invoice();
        $invoice->repairID = $request->input('repairID');
        $invoice->additionalCharges = $request->input('additionalCharges');
        // Calculate total amount based on repair cost and additional charges
        $invoice->totalAmount = $request->input('totalAmount');
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        // Validation

        $invoice = Invoice::findOrFail($id);
        $invoice->repairID = $request->input('repairID');
        $invoice->additionalCharges = $request->input('additionalCharges');
        // Calculate total amount based on repair cost and additional charges
        $invoice->totalAmount = $request->input('totalAmount');
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
