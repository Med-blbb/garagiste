@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 w-50 mb-10">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-5">Edit Appointment</h1>

    <form action="{{ route('admin.edit-appointment', $appointment->id) }}" method="POST" class="w-full max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <input type="text" id="status" name="status" value="{{ old('status', $appointment->status) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
            <input type="date" id="date" name="date" value="{{ old('date', $appointment->date) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Time</label>
            <input type="text" id="time" name="time" value="{{ old('time', $appointment->time) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flatpickr" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" placeholder="Select Time">
        </div>

        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Client ID</label>
            <input type="text" id="user_id" name="user_id" value="{{ old('user_id', $appointment->user_id) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
                Appointment</button>
            <a href="{{ route('admin.show-appointments') }}"
                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
        </div>
    </form>
</div>

<!-- Include Flatpickr library -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Initialize Flatpickr for time input -->
<script>
    flatpickr('#time', {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>

@endsection
