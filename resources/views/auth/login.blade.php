{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                
                {{-- Login Form Section --}}
                <div class="w-full lg:w-1/2 p-8 lg:p-12">
                    <div class="max-w-md mx-auto">
                        {{-- Header --}}
                        <div class="text-center lg:text-left mb-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ config('app.name', 'KAHATEXT') }}
                            </h1>
                            <p class="text-gray-600">
                                Silahkan masukkan email dan password Anda
                            </p>
                        </div>

                        {{-- Login Form --}}
                        <form action="" method="POST" class="space-y-6">
                            @csrf
                            
                            {{-- Email Field --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input 
                                    id="email"
                                    name="email" 
                                    type="email" 
                                    value="{{ old('email') }}"
                                    required 
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200 @error('email') border-red-500 @enderror"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password Field --}}
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <input 
                                        id="password"
                                        name="password" 
                                        type="password" 
                                        required 
                                        autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors duration-200 @error('password') border-red-500 @enderror"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="togglePassword()"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                    >
                                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Remember Me & Forgot Password --}}
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="remember" 
                                        class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                                <a href="{{ route('password.request') }}" class="text-sm text-cyan-600 hover:text-cyan-500 transition-colors">
                                    Forgot password?
                                </a>
                            </div>

                            {{-- Submit Button --}}
                            <button 
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200 transform hover:scale-105"
                            >
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Sign In
                                </span>
                            </button>
                        </form>

                        {{-- Register Link --}}
                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-600">
                                Belum punya akun?
                                <a href="" class="font-medium text-cyan-600 hover:text-cyan-500 transition-colors">
                                    Daftar sekarang
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Illustration Section --}}
                <div class="w-full lg:w-1/2 bg-gradient-to-br from-cyan-500 to-blue-600 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div class="relative h-64 lg:h-full flex items-center justify-center p-8">
                        <div class="text-center text-white">
                            <div class="w-32 h-32 mx-auto mb-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold mb-2">Welcome Back!</h2>
                            <p class="text-lg opacity-90">Sign in to access your account</p>
                        </div>
                    </div>
                    {{-- Decorative shapes --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full -ml-12 -mb-12"></div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Password Toggle Script --}}
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}
</script>
@endsection