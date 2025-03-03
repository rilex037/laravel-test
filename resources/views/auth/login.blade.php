@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="bg-white text-gray-800 w-full max-w-md p-8 rounded-lg shadow-lg">
    <div class="flex items-center justify-center mb-8">
        <img src="{{ asset('icons/lock.svg') }}" alt="Login" class="h-12 w-12 text-blue-600 mr-3">
        <h1 class="text-2xl font-bold">Secure Login</h1>
    </div>
    
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="{{ asset('icons/email.svg') }}" alt="Email" class="h-5 w-5 text-gray-400">
                </div>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="name@example.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>
            @error('email')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="{{ asset('icons/password.svg') }}" alt="Password" class="h-5 w-5 text-gray-400">
                </div>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="••••••••"
                    required
                >
            </div>
            @error('password')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
            </div>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Forgot your password?
                </a>
            @endif
        </div>
        
        <button 
            type="submit" 
            class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200"
        >
            <img src="{{ asset('icons/login.svg') }}" alt="Sign In" class="h-5 w-5 mr-2">
            Sign In
        </button>
    </form>
    
    @if (Route::has('register'))
        <div class="text-center mt-8 text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                Register here
            </a>
        </div>
    @endif
</div>
@endsection