@extends('layouts.app')
@section('title','Login - UKK E-Commerce')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-900 rounded-xl mb-4">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">UKK E-Commerce</h1>
            <p class="text-gray-500 text-sm mt-1">Masuk ke akun Anda</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            @include('partials.alert')
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"
                        placeholder="••••••••">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded">
                    <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                </div>
                <button type="submit" class="w-full bg-gray-900 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                    Masuk
                </button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-gray-900 font-semibold hover:underline">Daftar</a>
            </p>
        </div>
        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-xl p-4 text-xs text-blue-700 space-y-1">
            <p class="font-semibold">Akun Demo:</p>
            <p>Admin: admin@ukk.com / password</p>
            <p>Staff: staff@ukk.com / password</p>
            <p>User: user@ukk.com / password</p>
        </div>
    </div>
</div>
@endsection
