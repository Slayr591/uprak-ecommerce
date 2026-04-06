<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role','staff')->latest()->paginate(15);
        return view('admin.staff.index', compact('staff'));
    }

    public function create() { return view('admin.staff.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone'    => 'nullable|string|max:20',
        ]);
        User::create(['role'=>'staff','password'=>Hash::make($data['password'])] + $data);
        return redirect()->route('admin.staff.index')->with('success','Staff berhasil ditambahkan.');
    }

    public function edit(User $staff) { return view('admin.staff.edit', compact('staff')); }

    public function update(Request $request, User $staff)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$staff->id,
            'phone' => 'nullable|string|max:20',
        ]);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $staff->update($data);
        return redirect()->route('admin.staff.index')->with('success','Staff diperbarui.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success','Staff dihapus.');
    }
}
