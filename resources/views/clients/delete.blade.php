 @extends('layouts.app')

 @section('title', 'Delete Client')

 @section('content')
 <div class="bg-white text-black w-full max-w-4xl p-6 rounded-lg shadow-lg mx-auto mt-16">
     <div class="max-w-4xl mx-auto p-6">
         <h1 class="text-2xl font-bold text-gray-800 mb-6">Delete Client</h1>
         <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
             <p class="text-gray-800 mb-4">
                 Are you sure you want to delete the client
                 <span class="font-semibold">{{ $client->first_name }} {{ $client->last_name }}</span>?
                 This action cannot be undone.
             </p>

             <form action="{{ route('clients.destroy', $client) }}" method="POST" class="flex space-x-4">
                 @csrf
                 @method('DELETE')
                 <button
                     type="submit"
                     class="bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                     Yes, Delete Client
                 </button>
                 <a
                     href="{{ route('clients.index') }}"
                     class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                     Cancel
                 </a>
             </form>
         </div>
     </div>
 </div>
 @endsection