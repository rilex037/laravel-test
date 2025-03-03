@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white text-black w-1/2 p-6 rounded-lg shadow-lg mx-auto mt-16">
    <adviser-dashboard
        adviser-name="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
        csrf-token="{{ csrf_token() }}">
    </adviser-dashboard>
</div>
@endsection