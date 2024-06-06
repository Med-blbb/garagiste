@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-10 w-50">
    
@if (session('success'))
    <div class="container mx-auto mt-5 w-50 text-center mb-5">
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class=" w-50 text-center mb-5">
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class=" w-50 text-center mb-5">
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
    <h1 class="text-2xl font-bold text-center mb-5">Add Appointment</h1>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('client.add-appointment') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <input type="text" id="status" name="status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Service</option>
                    <option value="repair">Repair</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                <input type="date" id="date" name="date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                <input type="time" id="time" name="time" min="09:00" max="17:00" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            
            <div class="flex items-center justify-between">
                <a href="{{ route('client.appointments') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Appointments list
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
