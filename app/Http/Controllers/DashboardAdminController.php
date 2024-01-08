<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendence;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function ViewAdmin(){
        $totalAbsences = attendence::count();
        $totalPegawai = User::whereIn('role', ['pegawai', 'kasubag'])->count();
        // dd(session());
        return view('Admin/Dashboard/index',compact('totalAbsences','totalPegawai'));
    }

    public function Profiles(){
        // Ambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Periksa apakah pengguna terautentikasi
        if ($user) {
            // Lakukan sesuatu dengan $user
            // dd($user);

            // Kemudian, gunakan $user dalam tampilan atau logika lainnya
            return view('Admin.User.profile', compact('user'));
        }

        // Jika pengguna tidak terautentikasi, arahkan ke halaman login atau tempat lain
        return redirect('/admin')->with('error', 'You need to log in first.');
    }
}
