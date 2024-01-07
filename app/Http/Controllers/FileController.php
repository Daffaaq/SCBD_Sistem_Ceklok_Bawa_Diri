<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\file;

class FileController extends Controller
{
    public function index()
    {
        $jabatans = User::where('role', '!=', 'superadmin')
                    ->select('jabatan')
                    ->distinct()
                    ->get(); // Ambil data jabatan dari tabel user dengan role selain superadmin

        return view('Admin.Files.index', compact('jabatans'));
    }

    public function json(){
        $files = File::all();

        return DataTables::of($files)
            ->addColumn('action', function ($file) {
                // Tambahkan aksi atau tombol aksi yang diinginkan di sini
                return '<button class="btn btn-sm btn-danger delete-file" data-id="' . $file->id . '">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'file' => 'required|mimes:pdf,doc,docx|max:10240',
                'criteria_file' => 'required',
            ]);

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('private/files', $fileName, 'local');

            $fileRecord = File::create([
                'name' => $fileName,
                'path' => $path,
                'criteria_file' => $request->criteria_file,
                'file_date_created' => now()->toDateString(),
                'file_time_created' => now()->toTimeString(),
                'target_type' => $request->target_type,
                'target_id' => ($request->target_type === 'specific') ? $request->target_id : null,
            ]);
            // Mengembalikan respons JSON sukses
            return redirect('/superadmin/Files')->with('success', 'File uploaded successfully');
        } catch (\Exception $e) {
            // Mengembalikan respons JSON dengan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'File upload failed. ' . $e->getMessage()]);
        }
    }
    
    public function serveFile($id)
    {
        $file = File::findOrFail($id);
        $path = Storage::disk('local')->path($file->path);

    if (Storage::disk('local')->exists($file->path)) {
        return response()->file($path);
    } else {
        abort(404, 'File not found');
    }
    }

}
