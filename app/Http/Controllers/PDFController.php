<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    { 
        $invoice = Invoice::with('client')->findOrFail($id);
        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView('admin.pdf.invoice-pdf', $data);
        return $pdf->download('invoice.pdf');
    }
}
