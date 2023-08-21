@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="mx-auto px-4 py-8 rounded-lg sm:px-8 md:px-12 lg:px-16 transition-all">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @foreach ($events as $event)
                <a href="{{ route('events.show', ['event' => $event]) }}" class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0" data-replace='{"opacity-0":"opacity-100"}'>
                    <div class="h-40 bg-cover bg-center rounded-t-lg" style="background-image: url('{{ asset('/storage/' . $event->event_thumbnail) }}');"></div>
                    <h2 class="text-xl font-semibold mt-4 mb-2">{{ $event->event_name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $event->event_date }} | @ {{ $event->event_location }}</p>
                    <p class="text-gray-800 text-sm mt-3">{{ $event->description }}</p>
                    <p class="text-yellow-500 font-bold">Participants: {{ $event->event_applicants }} / {{ $event->event_applicants_limit }}</p>
                    <p class="text-red-500 text-sm">Application Deadline: {{ $event->event_application_deadline }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
