<?php

namespace App\Http\Controllers\mechanic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\SpairPart;
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
        // $vehicles = DB::table('vehicles')
        return view('mechanic.dashboard' ,compact(['repairs']));
    }
    public function repair()
    {
        $repairs = Repair::with(['spairParts', 'vehicle.users'])
            ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
            ->join('users as client', 'vehicles.user_id', '=', 'client.id')
            ->where('repairs.mechanic_id', '=', auth()->user()->id)
            ->select('repairs.*', 'vehicles.make', 'client.*')
            ->simplePaginate(5);
    
        return view('mechanic.repairs', compact('repairs'));
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
        return view('mechanic.edit-repair', compact('repair'));
    }
    public function updateRepair(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'start_date' => 'required',
            
        ]);
        $repair = Repair::find($request->id);
        if (!$repair){
            return response()->json(['error' => 'Repair not found.']);
        }
        $repair->status = $request->status;
        $repair->save();
        return response()->json(['success' => 'Repair updated successfully.']);
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

        return redirect()->route('admin.show-parts')->with('success', 'Spare part created successfully.');
    }
}
