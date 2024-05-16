<?php

namespace App\Http\Controllers\mechanic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SpairPart;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class MechanicProfileController extends Controller
{
    public function dashboard()
    {
        $repairs = DB::table('repairs')
        ->join('users as mechanics','repairs.mechanic_id','=','mechanics.id')
        ->join('vehicles','repairs.vehicle_id','=','vehicles.id')
        ->join('users as client','vehicles.user_id','=','client.id')
        ->where('mechanics.id','=',auth()->user()->id)
            ->simplePaginate(5);
        $vehicles = DB::table('vehicles')
                    ->join('repairs','vehicles.id','repairs.vehicle_id')
                    ->join('users as mechanics','repairs.mechanic_id','mechanics.id')
                    ->where('mechanics.id','=',auth()->user()->id)
                    ->select('vehicles.*')
                    ->simplePaginate(10);
        return view('mechanic.dashboard' ,compact(['repairs','vehicles']));
    }
    public function repair()
    {
        $repairs = Repair::with(['spairParts', 'vehicle.users'])
            ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
            ->join('users as client', 'vehicles.user_id', '=', 'client.id')
            ->join('users as mechanic','repairs.mechanic_id' ,'=','mechanic.id')
            ->where('repairs.mechanic_id', '=', auth()->user()->id)
            ->select('repairs.*','mechanic.name as mechanic_name', 'vehicles.make', 'client.id as client_id')
            ->simplePaginate(5);
    
        return view('mechanic.repairs', compact('repairs'));
    }
    public function vehicle ()
    {
        $vehicles = DB::table('vehicles')
            ->join('repairs','vehicles.id','repairs.vehicle_id')
            ->join('users as mechanics','repairs.mechanic_id','mechanics.id')
            ->where('mechanics.id','=',auth()->user()->id)
            ->select('vehicles.*')
            ->simplePaginate(10)
            ;
        return view('mechanic.vehicles',compact('vehicles'));
    }
    public function showVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id)
        ->where('id','=',$id)
        ->get();
        return view('mechanic.show-vehicle',compact('vehicle'));
    }
public function statusUpdateRepair(Request $request,$id)
    {
        $repair = Repair::find($id);
        if(!$repair){
            return response()->json(['error' => 'Repair not found.']);
        }
        $repair->status = $request->status;
        $repair->save();
        return response()->json(['success' => 'Repair status updated successfully.']);
    }
    public function storeSpare(Request $request)
    {
        $request->validate([
            'part_name' => 'required',
            'part_reference' => 'required',
            'supplier' => 'required',
            'price' => 'required',
            'repair_id' => 'required',
        ]);
        $spare = new SpairPart();
        $spare->part_name = $request->part_name;
        $spare->part_reference = $request->part_reference;
        $spare->supplier = $request->supplier;
        $spare->price = $request->price;
        $spare->repair_id = $request->repair_id;
        $spare->save();
        return redirect()->back()->with('success', 'Spare part added successfully.');
    }
    public function editRepair($id)
    {
        $repair = Repair::findOrFail($id);
        return view('mechanic.edit-repairs', compact('repair'));
    }
    public function updateRepair(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'mechanic_notes' => 'string|max:255'
            
        ]);
        $repair = Repair::find($request->id);
        if (!$repair){
            return response()->json(['error' => 'Repair not found.']);
        }
        
        $repair->status = $request->status;
        if($request->description){
        $repair->description = $request->description;
        }
        if($request->end_date){
            $repair->end_date = $request->end_date;
        }
        if($request->mechanic_notes){
            $repair->mechanic_notes = $request->mechanic_notes;
        }
        $repair->save();
        return back()->with(['success' => 'Repair updated successfully.']);
    }
    public function storePart(Request $request)
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

        return redirect()->back()->with('success', 'Spare part created successfully.');
    }
    public function storeInvoice(Request $request)
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
    
        return redirect()->route('mechanic.repairs')->with('success', 'Invoice created successfully.');
    }
}
