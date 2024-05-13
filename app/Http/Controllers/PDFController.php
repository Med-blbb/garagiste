<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Repair;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    { 
        
        $invoice = Invoice::with('client','repair')->findOrFail($id);
        
        
        $data = ['invoice' => $invoice];
        $pdf = FacadePdf::loadView('admin.pdf.invoice-pdf', $data);
        return $pdf->download('invoice.pdf');
    }
}
