<?php

namespace App\Http\Controllers\mechanic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MechanicProfileController extends Controller
{
    public function dashboard()
    {
        $repairs = DB::table('repairs')
            ->join('users','repairs.mechanic_id','=','users.id')
            ->where('users.id','=','mechanic_id')
            ->select('repairs.*','repairs.mechanic_id')
            ->simplePaginate(5);
        // $vehicles = DB::table('vehicles')
        return view('mechanic.dashboard' ,compact(['repairs']));
    }
    public function repair ()
    {
        $repairs = DB::table('repairs')
        ->join('users as mechanics','repairs.mechanic_id','=','mechanics.id')
        ->join('vehicles','repairs.vehicle_id','=','vehicles.id')
        ->join('users as client','vehicles.user_id','=','client.id')
        ->where('mechanics.id','=',auth()->user()->id)
        ->select('repairs.*')
        ->simplePaginate(5); 
    
        return view('mechanic.repairs',compact(['repairs']));
            
    }
}
