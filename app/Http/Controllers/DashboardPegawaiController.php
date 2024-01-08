<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendence;
use Illuminate\Support\Facades\Auth;

class DashboardPegawaiController extends Controller
{
    public function ViewPegawai(){
        // dd(session());
        return view('Pegawai/layouts/index');
    }
    public function Profiles(){
        // Ambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Periksa apakah pengguna terautentikasi
        if ($user) {
            // Lakukan sesuatu dengan $user
            // dd($user);

            // Kemudian, gunakan $user dalam tampilan atau logika lainnya
            return view('Pegawai.Profiles.index', compact('user'));
        }

        // Jika pengguna tidak terautentikasi, arahkan ke halaman login atau tempat lain
        return redirect('/admin')->with('error', 'You need to log in first.');
    }
}
