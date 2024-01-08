<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\attendence;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class KasubagAttendence extends Controller
{
    public function json($userId)
    {
        $attendances = Attendence::where('user_id', $userId)
            ->select([
                'attendences.id',
                'attendences.attendences_time',
                'attendences.attendences_date',
                'attendences.attendance_status',
                'attendences.attendences_Status'
            ])
            ->get();

        return DataTables::of($attendances)
            ->addColumn('action', function ($attendance) {
                // You can add additional columns or actions here
                return '<button class="btn btn-sm btn-info" onclick="deleteAttendance(' . $attendance->id . ')">Delete</button>';
            })
            ->make(true);
    }

    public function index()
    {
        // Ambil semua user yang memiliki role 'pegawai'
        $pegawaiUsers = DB::table('users')->where('role', 'pegawai')->get();

        return view('kasubag.Absensi.index', ['pegawaiUsers' => $pegawaiUsers]);
    }

    public function acceptAttendance($id)
    {
        $attendance = attendence::findOrFail($id);
        $attendance->attendences_Status = 'accepted';
        $attendance->save();

        return response()->json(['message' => 'Attendance accepted successfully']);
    }

    public function rejectAttendance($id)
    {
        $attendance = attendence::findOrFail($id);
        $attendance->attendences_Status = 'rejected';
        $attendance->save();

        return response()->json(['message' => 'Attendance rejected successfully']);
    }
}
