@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="bg-white text-black w-1/2 p-6 rounded-lg shadow-lg">
        <counter-component data-initial-count="{{ json_encode($initialCount ?? 0) }}"></counter-component>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a>
        </div>
    </div>
@endsection