<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendence;

class DashboardAdminController extends Controller
{
    public function ViewAdmin(){
        $totalAbsences = attendence::count();
        $totalPegawai = User::whereIn('role', ['pegawai', 'kasubag'])->count();
        // dd(session());
        return view('Admin/Dashboard/index',compact('totalAbsences','totalPegawai'));
    }
}
