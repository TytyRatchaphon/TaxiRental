@extends('layouts.main')

@section('content')
<header class="bg-cover drop-shadow rounded-b bg-gradient-to-r from-[#f75394] to-yellow-300 py-20 text-center relative">
        <div>
            <div class="duration-500 relative transform transition-all translate-y-12 ease-out opacity-0"
                data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow">
                    <h1 class="text-[5vh] md:text-[7vh] transition-all font-semibold">Manage Your taxi</h1>
                </div>
            </div>

            <div class="duration-1000 relative transform transition-all opacity-0"
                data-replace='{ "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow mb-8">
                </div>
            </div>
        </div>
    </header>
    @if (!$bookings->isEmpty())
        <div class=" mx-auto px-4 py-8 rounded-lg sm:px-8 md:px-12 lg:px-16 transition-all">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                @foreach ($bookings as $booking)
                    <a href="{{ route('bookings.show', ['booking' => $booking]) }}"
                        class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0"
                        data-replace='{"opacity-0":"opacity-100"}'>
                        <div class="h-40 bg-cover bg-center rounded-t-lg">
                                <img src="{{ asset('default-img/event_thumbnail.jpg') }}"
                                    alt="Default Event Image" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-semibold mt-4 mb-2">Username: {{ $booking->user->F_name }}</h2>
                    
                        <p class="text-gray-600 text-sm"> Booking Id: {{ $booking->id }} || Booking Status: {{ $booking->B_status }}</p>
                        <form action="{{ route('bookings.return', ['booking' => $booking]) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="flex">
                                <button type="submit" onclick="return confirm('Are you sure you want to return this car?')"
                                    class="bg-[#de422a] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2 mt-3">Return</button>
                            </div>
                        </form>
                     </a>
                @endforeach
            </div>

        @else
            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                <h1 class="text-center text-gray-300 py-10">You did not book taxi yet</h1>
            </div>
    @endif


    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/data-replacer.js') }}"></script>
@endsection