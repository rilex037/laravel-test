@extends('layouts.app')

@section('title', 'All Clients')

@section('content')
<div class="bg-white text-black w-full max-w-4xl p-6 rounded-lg shadow-lg mx-auto mt-16">
    <clients-list
        clients-data="{{ json_encode($clients) }}"
        csrf-token="{{ csrf_token() }}"
    ></clients-list>
</div>
@endsection