<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardKasubagController extends Controller
{
    public function ViewKasubag(){
        // dd(session());
        return view('Kasubag/layouts/index');
    }
}
