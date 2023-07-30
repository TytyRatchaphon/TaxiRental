@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="mx-auto px-4 py-8 sm:px-8 md:px-12 lg:px-16">

        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('home') }}" method="GET" class="flex items-center">
                <input type="text" name="search" id="search" class="form-control w-full rounded-l-lg py-2 px-4"
                    placeholder="Search Events">
                <button type="submit"
                    class="bg-[#F6D106] hover:bg-[#F6D106] text-white outline outline-1 outline-gray-500 rounded-r-lg py-2 px-4">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        <!-- promt a suggestions -->
            <div id="search-suggestions"
                class="py-2 px-4 bg-white shadow-lg rounded-lg hidden sm:left-0 sm:right-0"   >
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @foreach ($events as $event)
                <div class="bg-white transition-transform duration-500 hover:scale-110 rounded-lg shadow-md p-6">
                    <div class="h-40 bg-cover bg-center rounded-t-lg"
                        style="background-image: url('{{ $event->event_thumbnail }}');"></div>
                    <h2 class="text-xl font-semibold mt-4 mb-2">{{ $event->event_name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $event->event_date }} | {{ $event->event_location }}</p>
                    <p class="text-gray-800 text-sm mt-3">{{ $event->description }}</p>
                    <p class="text-yellow-500 font-bold ">Participants:
                        {{ $event->event_participant }}/{{ $event->event_participant_limit }}</p>
                    <p class="text-red-500 text-sm ">Application deadline: {{ $event->event_application_deadline }}
                    </p>
                    <!-- Add more event details here -->
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/search.js') }}"></script>
@endsection
