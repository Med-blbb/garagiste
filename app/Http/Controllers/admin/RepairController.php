<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\SpairPart;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::simplepaginate(5);
        return view('admin.repair.show-repair', ['repairs' => $repairs]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'mechanic_id' => 'required',
            'description' => 'required',
            'start_date' => 'required',
        ]);
        $repair = new Repair();

        $repair->description = $request->description;
        $repair->status = $request->status;
        $repair->start_date = $request->start_date;
        $repair->end_date = $request->end_date;
        $repair->mechanic_notes = $request->mechanic_notes;
        $repair->client_notes = $request->client_notes;
        $repair->vehicle_id = $request->vehicle_id;
        $repair->mechanic_id = $request->mechanic_id;
        $repair->save();
        return redirect()->back()->with('success', 'Repair added successfully.');
    }
    public function create()
    {
        return view('admin.repair.add-repair');
    }
    public function edit($id)
    {
        $repair = Repair::findOrFail($id);
        return view('admin.repair.edit-repair', compact('repair'));
    }
    public function update(Request $request , $id)
    {
        
        $repair = Repair::find($id);
        if (!$repair){
            return response()->json(['error' => 'Repair not found.']);
        }
        $request->validate([
            'vehicle_id' => 'required',
            'mechanic_id' => 'required',
            'description' => 'required',
            'start_date' => 'required',
        ]);
       
        $repair->status = $request->status;
        $repair->start_date = $request->start_date;
        $repair->end_date = $request->end_date;
        $repair->mechanic_notes = $request->mechanic_notes;
        $repair->client_notes = $request->client_notes;
        $repair->vehicle_id = $request->vehicle_id;
        $repair->mechanic_id = $request->mechanic_id;
        if($request->spair_id){
        $repair->spair_id = $request->spair_id;
        }
        
        
        $repair->save();
        return redirect()->back()->with('success', 'Repair updated successfully.');
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
    public function destroy($id)
    {
        $repair = Repair::find($id);
        $invoice=Invoice::where('repair_id',$id)->first();
        $parts=SpairPart::where('repair_id',$id)->get();
        if(!$repair){
            return redirect()->back()->whith('error','Repair not found');
        }
        if($invoice){
            $invoice->delete();
        }
        if($parts){
            foreach($parts as $part){
                $part->delete();
            }
        }
        $repair->delete();
        return redirect()->back()->with('success',"Repair deleted successfully");
    }
    
    
}
