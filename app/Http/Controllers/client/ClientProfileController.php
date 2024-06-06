<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentUpdatedNotification;
use App\Models\Appointment;
use App\Models\Repair;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\ClientNotification;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientProfileController extends Controller
{
    public function dashboard()
    {
        $vehicle = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email');
        $repair = DB::table('repairs')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->where('users.id', '=', auth()->user()->id)
        ->select('repairs.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email', 'users.address', 'users.phoneNumber');
        $invoice= DB::table('invoices')
        ->join('repairs', 'invoices.repair_id', '=', 'repairs.id')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('invoices.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email', 'users.address', 'users.phoneNumber');
        $appointments = DB::table('appointments')
        ->join('users','appointments.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('appointments.*',  'users.name', 'users.email', 'users.address', 'users.phoneNumber');
        return view('client.dashboard', compact(['vehicle', 'repair', 'invoice', 'appointments']));
    }
    public function vehicle()
    {
        $vehicles = DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('vehicles.*', 'vehicles.make', 'vehicles.model', 'users.name', 'users.email', 'users.address', 'users.phoneNumber')
        ->Paginate(1);
        return view('client.vehicles', compact('vehicles'));
    }
    public function repair()
    {
        $repairs = DB::table('repairs')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users as mechanics', 'repairs.mechanic_id', '=', 'mechanics.id')
        ->join('users as clients', 'vehicles.user_id', '=', 'clients.id')
        ->where('clients.id', '=', auth()->user()->id)
        ->select('repairs.*', 'mechanics.name as mechanic_name','vehicles.make', 'vehicles.model', 'clients.name as client_name', 'clients.email', 'clients.address', 'clients.phoneNumber')
        ->simplePaginate(5);
        return view('client.repairs', compact('repairs'));
    }
    public function updateClientNote(Request $request, $id)
{
    $repair = Repair::find($id);
    if(!$repair){
        return response()->json(['error' => 'Repair not found.'], 404);
    }
    
    $request->validate([
        'clientNote' => 'required|string', // Change to clientNote to match the form data
    ]);

    $repair->client_notes = $request->clientNote; // Change to clientNote to match the form data
    $repair->save();
    return response()->json(['success' => 'Client note updated successfully.']);
}
    public function invoice()
    {
        $invoices = DB::table('invoices')
        ->join('repairs', 'invoices.repair_id', '=', 'repairs.id')
        ->join('vehicles', 'repairs.vehicle_id', '=', 'vehicles.id')
        ->join('users as mechanics', 'repairs.mechanic_id', '=', 'mechanics.id')
        ->join('users as clients', 'vehicles.user_id', '=', 'clients.id')
        ->where('clients.id', '=', auth()->user()->id)
        ->select('invoices.*', 'vehicles.make', 'vehicles.model',
             'clients.name as client_name', 
             'clients.email', 'clients.address', 'clients.phoneNumber',
             'repairs.description as repair_description',
             'mechanics.name as mechanic_name', 'mechanics.email as mechanic_email', 'mechanics.address as mechanic_address', 'mechanics.phoneNumber as mechanic_phoneNumber')
        ->simplePaginate(5);
        return view('client.invoice', compact('invoices'));
    }
    public function appointment()
    {
        $appointments = DB::table('appointments')
        ->join('users','appointments.user_id', '=', 'users.id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('appointments.*',  'users.name', 'users.email', 'users.address', 'users.phoneNumber')
        ->simplePaginate(5);
        return view('client.appointments', compact('appointments'));
    }
    public function createAppointment()
    {
        return view('client.add-appointment');
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'status' => 'required|string',
            'date' => 'required|date',
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $startTime = \Carbon\Carbon::createFromFormat('H:i', '09:00');
                    $endTime = \Carbon\Carbon::createFromFormat('H:i', '17:00');
                    $appointmentTime = \Carbon\Carbon::createFromFormat('H:i', $value);
    
                    if ($appointmentTime->lessThan($startTime) || $appointmentTime->greaterThan($endTime)) {
                        $fail('The ' . $attribute . ' must be between 09:00 and 17:00.');
                    }
                },
            ],
        ]);
    
        // Check if an appointment already exists for the user on the same day
        $existingAppointment = Appointment::where('user_id', $request->user_id)
                                          ->whereDate('date', $request->date)
                                          ->first();
    
        if ($existingAppointment) {
            return redirect()->back()->with('error', 'An appointment for this client already exists on this day.');
        }
    
        // Check if the selected time is already taken
        $timeTaken = Appointment::where('date', $request->date)
                                ->where('time', $request->time)
                                ->exists();
    
        if ($timeTaken) {
            return redirect()->back()->with('error', 'The selected time is already taken.');
        }
    
        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->type = $request->type;
        $appointment->status = $request->status;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        
        $appointment->save();
        // Notify admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new AdminNotification($appointment));
        }

    // Notify client
    $client = $appointment->user;
    $client->notify(new ClientNotification($appointment));
    
        return redirect()->route('client.appointments')->with('success', 'Appointment created successfully.');
    }
    public function destroyAppointment ($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back();
    }
    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('client.edit-appointment', compact('appointment'));
    }

    public function updateAppointment(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string',
        'date' => 'required|date',
        'time' => [
            'required',
            'date_format:H:i',
            
            function ($attribute, $value, $fail) {
                $startTime = \Carbon\Carbon::createFromFormat('H:i', '09:00');
                $endTime = \Carbon\Carbon::createFromFormat('H:i', '17:00');
                
                // Debugging: Print $value to see its content
                

                // Check if $value is not empty and is a string
                if (!empty($value) && is_string($value)) {
                    // Attempt to create Carbon instance
                    try {
                        $appointmentTime = \Carbon\Carbon::createFromFormat('H:i', $value);
                    } catch (\Exception $e) {
                        // Debugging: Print exception message
                        dump($e->getMessage());
                        $fail('Invalid time format.');
                    }

                    // Check if $appointmentTime is a valid Carbon instance
                    if (isset($appointmentTime) && $appointmentTime instanceof \Carbon\Carbon) {
                        // Check if the appointment time is within the allowed range
                        if ($appointmentTime->lessThan($startTime) || $appointmentTime->greaterThan($endTime)) {
                            $fail('The ' . $attribute . ' must be between 09:00 and 17:00.');
                        }
                    } else {
                        $fail('Invalid time format.');
                    }
                } else {
                    $fail('Invalid time format.');
                }
            },
        ],
    ]);

    $appointment = Appointment::findOrFail($id);
    $oldAppointment = clone $appointment; // Create a clone of the old appointment before updating
    $clientName = $appointment->user->name;

    $appointment->update($request->all());

    // Notify admin
    $admins = User::where('role', 'admin')->select('id', 'email')->get();
    foreach ($admins as $admin) {
        Mail::to($admin->email)->send(new AppointmentUpdatedNotification($appointment, $clientName));
    }
    // Notify client
    Mail::to($appointment->user->email)->send(new AppointmentUpdatedNotification($appointment, $clientName));

    return redirect()->route('client.appointments')->with('success', 'Appointment updated successfully.');
}
}
