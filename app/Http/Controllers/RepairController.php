<?php

namespace App\Http\Controllers;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function showAllRepairs()
    {
        $repairs = Repair::all();
        return view('admin.repairs', ['repairs' => $repairs]);
    }
}
