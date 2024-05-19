<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentUpdatedNotification;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\ClientNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index ()
    {
        $appointments = DB::table('appointments')
        ->join('users', 'appointments.user_id', '=', 'users.id')
        ->select('appointments.*', 'users.name as client_name')
        ->simplePaginate(10);
        return view('admin.appointment.show-appointments', compact('appointments'));
    }
    
    public function destroy ($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointment.edit-appointment', compact('appointment'));
    }

    public function update(Request $request, $id)
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

    return redirect()->route('admin.show-appointments')->with('success', 'Appointment updated successfully.');
}


    
    public function create()
    {
        return view('admin.appointment.add-appointment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
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
    
        $appointment = Appointment::create($request->all());
        $appointment->save();
        // Notify admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new AdminNotification($appointment));
        }

    // Notify client
    $client = $appointment->user;
    $client->notify(new ClientNotification($appointment));
    
        return redirect()->route('admin.show-appointments')->with('success', 'Appointment created successfully.');
    }
   
    

}
