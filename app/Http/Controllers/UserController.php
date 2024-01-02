<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('Admin.User.index');
    }
    public function create(){
        return view('Admin.User.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|numeric',
            'jabatan' => 'required|string|max:255',
            'role' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'no_telp' => $request->input('no_telp'),
            'jabatan' => $request->input('jabatan'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            'password' => bcrypt($request->input('password')),
        ]);
         return redirect('/superadmin/users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.User.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|numeric',
            'jabatan' => 'required|string|max:255',
            'role' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6', // optional, only if you want to update the password
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'no_telp' => $request->input('no_telp'),
            'jabatan' => $request->input('jabatan'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        return redirect('/superadmin/users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function getUsersData()
    {
        $users = User::select([
        'id',
        'name',
        'email',
        'jabatan',
        'no_telp',
        'role', 
        ])
        ->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
                return "<a href='" . url('/superadmin/users/edit/' . $user->id) . "'>
                        <button class='btn btn-sm btn-primary'>Edit</button>
                    </a> <button class='btn btn-sm btn-danger' onclick='deleteUser($user->id)'>Delete</button>";
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
