@extends('layouts.app')

@section('title', $client ? 'Edit Client' : 'Create Client')

@section('content')
<meta name="success-message" content="{{ session('success') }}">
<meta name="errors" content="{{ json_encode($errors->all() ? $errors->messages() : null) }}">
<div class="bg-white text-black w-full max-w-4xl p-6 rounded-lg shadow-lg mx-auto mt-16">
    <client-form
        client="{{ $client ? json_encode($client) : null }}"
        action="{{ $action }}"
        method="{{ $method }}"
        csrf-token="{{ csrf_token() }}"
        adviser-id="{{ Auth::id() }}"
    ></client-form>
</div>
@endsection