<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (auth()->check()) return $this->redirectByRole();

        $backUrl = $this->resolveGuestRedirect($request);
        return view('auth.login', compact('backUrl'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'redirect' => 'nullable|string',
        ]);

        if (Auth::attempt($request->only('email','password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            if (!auth()->user()->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda dinonaktifkan.']);
            }

            if (auth()->user()->role === 'user') {
                return redirect()->to($this->resolveGuestRedirect($request));
            }

            return $this->redirectByRole();
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function showRegister(Request $request)
    {
        $backUrl = $this->resolveGuestRedirect($request);
        return view('auth.register', compact('backUrl'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:8|confirmed',
            'phone'            => 'nullable|string|max:20',
            'redirect'         => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'    => $data['phone'] ?? null,
            'role'     => 'user',
        ]);

        Auth::login($user);

        return redirect()->to($this->resolveGuestRedirect($request))
            ->with('success', 'Akun berhasil dibuat! Selamat berbelanja.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    private function resolveGuestRedirect(Request $request): string
    {
        $target = $request->input('redirect', $request->query('redirect'));

        if (!is_string($target) || trim($target) === '') {
            return route('user.products');
        }

        $target = trim($target);

        if (str_starts_with($target, '/')) {
            return url($target);
        }

        $targetHost = parse_url($target, PHP_URL_HOST);
        $targetScheme = parse_url($target, PHP_URL_SCHEME);

        if (
            is_string($targetHost) &&
            $targetHost === $request->getHost() &&
            in_array($targetScheme, ['http', 'https'], true)
        ) {
            return $target;
        }

        return route('user.products');
    }

    private function redirectByRole()
    {
        return match(auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            default => redirect()->route('user.products'),
        };
    }
}
