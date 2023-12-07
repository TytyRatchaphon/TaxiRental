@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <header class="bg-cover drop-shadow rounded-b bg-gradient-to-r from-[#f75394] to-yellow-300 py-20 text-center relative">
        <div>
            <div class="duration-500 relative transform transition-all translate-y-12 ease-out opacity-0"
                data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow">
                    <h1 class="text-[5vh] md:text-[7vh] transition-all font-semibold">Manage Payment</h1>
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
                        @if($booking->B_status == 'PENDING')
                            <a href=""
                                class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0"
                                data-replace='{"opacity-0":"opacity-100"}'>
                                @if($booking->payment->payment_method == 'transfer')
                                    <div class="h-40 bg-cover bg-center rounded-t-lg">
                                            <img src="{{ asset('default-img/receipt.jpg') }}"
                                                alt="Default Event Image" class="w-full h-full object-cover">
                                    </div>
                                @else
                                <div class="h-40 bg-cover bg-center rounded-t-lg">
                                            <img src="{{ asset('default-img/cash.jpg') }}"
                                                alt="Default Event Image" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                @if($booking->payment->payment_method == 'cash')
                                    <h2 class="text-xl font-semibold mt-4 mb-2">Payment Method : {{ $booking->payment->payment_method }}</h2>
                                    <p class="text-gray-600 text-sm">User : {{ $booking->user->F_name }}</p>
                                    <p class="text-gray-600 text-sm">Pickup Car Date : {{ $booking->payment->P_date }}</p>
                                @else
                                    <h2 class="text-xl font-semibold mt-4 mb-2">Payment Method : {{ $booking->payment->payment_method }}</h2>
                                    <p class="text-gray-600 text-sm">User : {{ $booking->user->F_name }}</p>
                                    <p class="text-gray-600 text-sm">Pay Date : {{ $booking->payment->created_at }}</p>
                                @endif
                                @auth
                                    <div>
                                        <form action="{{ route('bookings.apply',['booking' => $booking]) }}" method="POST">
                                            @csrf
                                            <div class="flex">
                                                    <button type="submit" onclick="return confirm('Are you sure you want to Accept this payment?')"
                                                        class="bg-[#6ef62f] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2 mt-3">Approve</button>
                                            </div>
                                        </form>
                                        <form action="{{ route('bookings.reject', ['booking' => $booking]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex">
                                                    <button type="submit" onclick="return confirm('Are you sure you want to Reject this payment?')"
                                                        class="bg-[#de422a] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2 mt-3">Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                @endauth
                            </a>
                        @else
                        <a href=""
                                class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0"
                                data-replace='{"opacity-0":"opacity-100"}'>
                                @if($booking->payment->payment_method == 'transfer')
                                    <div class="h-40 bg-cover bg-center rounded-t-lg">
                                            <img src="{{ asset('default-img/receipt.jpg') }}"
                                                alt="Default Event Image" class="w-full h-full object-cover">
                                    </div>
                                @else
                                <div class="h-40 bg-cover bg-center rounded-t-lg">
                                            <img src="{{ asset('default-img/cash.jpg') }}"
                                                alt="Default Event Image" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                @if($booking->payment->payment_method == 'cash')
                                    <h1 class="text-xl font-semibold mt-4 mb-2">{{ $booking->B_status }}</h1>
                                    <h2 class="text-xl font-semibold mt-4 mb-2">Payment Method : {{ $booking->payment->payment_method }}</h2>
                                    <p class="text-gray-600 text-sm">User : {{ $booking->user->F_name }}</p>
                                    <p class="text-gray-600 text-sm">Pickup Car Date : {{ $booking->payment->P_date }}</p>
                                @else
                                    <h2 class="text-xl font-semibold mt-4 mb-2">Payment Method : {{ $booking->payment->payment_method }}</h2>
                                    <p class="text-gray-600 text-sm">User : {{ $booking->user->F_name }}</p>
                                    <p class="text-gray-600 text-sm">Pay Date : {{ $booking->payment->created_at }}</p>
                                @endif
                            </a>
                        @endif
                @endforeach
            </div>
        @else
            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                <h1 class="text-center text-gray-300 py-10">No Payment pending</h1>
            </div>
    @endif

    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/data-replacer.js') }}"></script>
@endsection