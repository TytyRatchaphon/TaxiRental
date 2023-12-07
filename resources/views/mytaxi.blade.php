@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <header class="bg-cover drop-shadow rounded-b bg-gradient-to-r from-[#f75394] to-yellow-300 py-20 text-center relative">
        <div>
            <div class="duration-500 relative transform transition-all translate-y-12 ease-out opacity-0"
                data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow">
                    <h1 class="text-[5vh] md:text-[7vh] transition-all font-semibold">Discover Your taxi</h1>
                </div>
            </div>

            <div class="duration-1000 relative transform transition-all opacity-0"
                data-replace='{ "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow mb-8">
                </div>
            </div>
        </div>

        
    </header>

    @if (!$taxis->isEmpty())
        <div class=" mx-auto px-4 py-8 rounded-lg sm:px-8 md:px-12 lg:px-16 transition-all">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                @foreach ($taxis as $taxi)
                    <a href=""
                        class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0"
                        data-replace='{"opacity-0":"opacity-100"}'>
                        <div class="h-40 bg-cover bg-center rounded-t-lg">
                                <img src="{{ asset('default-img/event_thumbnail.jpg') }}"
                                    alt="Default Event Image" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-semibold mt-4 mb-2">Car Status : {{ $taxi->B_status }}</h2>
                        <p class="text-gray-600 text-sm"> Booked Date : {{ $taxi->B_date }} </p>
                        <p>
                            @auth
                                @if(Auth::user()->isRole('ADMIN')  && $taxi->car_status === 'available')
                                    <p class="text-lg text-green-500">Status: {{ $taxi->car_status }}
                                @elseif( Auth::user()->isRole('ADMIN') && $taxi->car_status === 'pending')
                                    <p class="text-lg text-yellow-500">Status: {{ $taxi->car_status }}
                                @elseif(Auth::user()->isRole('ADMIN') && $taxi->car_status === 'occupied')
                                    <p class="text-lg text-red-500">Status: {{ $taxi->car_status }}
                                 @endif
                             @endauth
                        </p>
                        @auth
                            @if ($taxi->car_status !== 'approved')
                                @if (Auth::user()->isRole('ADMIN') || (Auth::user()->isRole('STUDENT') && $event->isStudentEvent(Auth::user()->student, 'HEAD')))
                                <div class="flex">
                                    <form action="{{ route('events.destroy', ['taxi' => $taxi]) }}" method="POST" class="mr-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to DELETE THIS TAXI?')"
                                            class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Delete</button>
                                    </form>
                                    <form action="{{ route('events.edit', ['taxi' => $taxi]) }}">
                                        @csrf
                                        @method('GET')
                                        <button type="submit"
                                            class="bg-[#69e932] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Edit</button>
                                    </form>
                                </div>
                                @endif
                            @endif 
                        @endauth 
                     </a>
                @endforeach
            </div>
        @else
            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                <h1 class="text-center text-gray-300 py-10">You don't have taxi</h1>
            </div>
    @endif

    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/data-replacer.js') }}"></script>
@endsection