@extends('layouts.main')
@section('content')
<div class="p-10 px-20">
    <div class="">
        <div class="my-5 object-cover">
            <img src="{{ asset('storage/' . $event->event_image) }}" class="rounded-lg w-full h-[70vh]">
        </div>
    </div>
    <div class="">
        <div class="flex flex-inline space-x-4">

            <ul class="flex p-2 pl-0 mb-5">
                <li class="flex bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded"><i
                        class="fa-solid fa-crown pt-1 text-center mr-2 "
                        style="color: black;"></i>{{ $event->headEvent()->user->username }}
                </li>
                @auth
                @can('showStatus', $event)
                <li id="status"
                    class="bg-{{ $event->isStatus('approved') ? 'gray-100' : 'green' }} p-1 pl-3 pr-3 mr-5 rounded">
                    {{ $event->event_approval_status }}
                </li>
                @endcan

                @can('viewKanban', $event)
                <a href="{{ route('events.kanbans.show', ['event' => $event]) }}" class="p-1 pl-3 pr-3 mr-5">
                    Manage Event
                </a>
                @endcan

                @endauth
            </ul>
        </div>
        <h1 class="text-xl font-semibold">{{ $event->event_name }}</h1>
        <pre class="flex text-gray-700 leading-tight mb-4 break-all overflow-auto">{{ $event->event_description }}</pre>
        <p>Location: {{ $event->event_location }}</p>
        <div class="flex justify-between items-cente mt-16">
            <div class="">
                <h1>Participants {{ $event->getApplicant('APPROVED')->count() }} / {{ $event->event_applicants_limit }}
                </h1>
                <p class="text-gray-600">Event Start: {{ $event->event_date }} </p>
                <p class="text-gray-600">Deadline to JOIN: {{ $event->event_application_deadline }}</p>
            </div>
            <div class="flex mt-20 justify-end">
                @auth
                <form method="POST" action="{{ route('events.apply', ['event' => $event]) }}">
                    @csrf
                    @can('requestJoin', $event)
                    <button type="submit"
                        class="bg-[#F6D106] p-1 pl-5 pr-5 mr-5 rounded transition-all hover:opacity-80">
                        apply for event
                    </button>
                    @endcan
                    @if (session('success'))
                    <div class="bg-green-300 text-green-800 p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                    @endif
                </form>
                @endauth

                <a href="{{ url('/home') }}">
                    <button type="submit"
                    class="bg-[#FF6666] p-1 px-10 rounded transition-all hover:opacity-80">back</button>
                </a>
                
            </div>
        </div>
    </div>
</div>
@endsection