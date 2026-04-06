<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::when(request('role'), fn($q) => $q->where('role', request('role')))
            ->when(request('search'), fn($q) => $q->where('name','like','%'.request('search').'%')
                ->orWhere('email','like','%'.request('search').'%'))
            ->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create() { return view('admin.users.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,staff,user',
            'phone'    => 'nullable|string|max:20',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.users.index')->with('success','Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user) { return view('admin.users.edit', compact('user')); }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role'  => 'required|in:admin,staff,user',
            'phone' => 'nullable|string|max:20',
        ]);
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Tidak bisa menghapus akun sendiri.');
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','Pengguna dihapus.');
    }

    public function toggle(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', $user->is_active ? 'Akun diaktifkan.' : 'Akun dinonaktifkan.');
    }
}
