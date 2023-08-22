@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <header class="bg-cover drop-shadow rounded-b bg-gradient-to-r from-[#f75394] to-yellow-300 py-20 text-center relative">
        <div>
            <div class="duration-500 relative transform transition-all translate-y-12 ease-out opacity-0"
                data-replace='{ "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow">
                    <h1 class="text-[5vh] md:text-[7vh] transition-all font-semibold">Discover Your Next Event</h1>
                </div>
            </div>

            <div class="duration-1000 relative transform transition-all opacity-0"
                data-replace='{ "opacity-0": "opacity-100" }'>
                <div class="text-white drop-shadow mb-8">
                    <p class="text-lg md:text-xl transition-all ">Effortlessly Manage and Organize Events</p>
                </div>
            </div>
        </div>

        <div class="my-6 m-auto w-[60vh] sm:w-[80vh] relative opacity-0 duration-700"
            data-replace='{"opacity-0": "opacity-100"}'>
            <form action="{{ route('home') }}" method="GET" class="flex items-center">
                <input type="text" name="search" id="search"
                    class="drop-shadow border-transparent focus:border-transparent focus:ring-0 form-control w-full rounded-l-lg py-2 px-4"
                    placeholder="Search Events">
                <button type="submit"
                    class="z-50 drop-shadow bg-white text-gray-400 transition duration-300 hover:text-[#F6D106] rounded-r-lg py-[8.8px] sm:py-[8.6px] px-4">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <!-- Display search suggestions -->
            <p id="search-suggestions"
                class="cursor-pointer absolute m-auto text-left w-[80vh] py-2 px-4 bg-slate-100 shadow-lg rounded hidden sm:left-0 sm:right-0">
            </p>
        </div>
    </header>

    @if (!$events->isEmpty())
        <div class=" mx-auto px-4 py-8 rounded-lg sm:px-8 md:px-12 lg:px-16 transition-all">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                @foreach ($events as $event)
                    <a href="{{ route('events.show', ['event' => $event]) }}"
                        class="bg-white transition-all duration-1000 hover:scale-105 rounded-lg shadow-md p-6 opacity-0"
                        data-replace='{"opacity-0":"opacity-100"}'>
                        <div class="h-40 bg-cover bg-center rounded-t-lg">
                            @if ($event->event_thumbnail)
                                <img src="{{ asset('storage/' . $event->event_thumbnail) }}" alt="Event Thumbnail"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="https://cdn.discordapp.com/attachments/1132651254057795625/1143231381334409266/event_thumbnail.jpeg"
                                    alt="Default Event Image" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <h2 class="text-xl font-semibold mt-4 mb-2">{{ $event->event_name }}</h2>
                        <p class="text-gray-600 text-sm">Event Day : {{ $event->event_date }} | @ {{ $event->event_location }}</p>
                        <p class="text-gray-800 text-sm mt-3">{{ $event->description }}</p>
                        <p class="text-yellow-500 font-bold">Participants:
                            {{ $event->getApplicant('APPROVED')->count() }} / {{ $event->event_applicants_limit }}</p>
                        <p class="text-red-500 text-sm">Application Deadline: {{ $event->event_application_deadline }}
                        </p>
                        <p>
                            @auth
                                @if(Auth::user()->isRole('STUDENT') && $event->hasStudentInEvent(Auth::user()->student) && $event->students()->find(Auth::user()->student->id)->pivot->status === 'approved' && !$event->isStudentEvent(Auth::user()->student, 'HEAD'))
                                    <p class="text-green-500 text-lg font-semibold pt-5">You are joined this event.</p>
                                @elseif(Auth::user()->isRole('STUDENT') && $event->hasStudentInEvent(Auth::user()->student) && $event->students()->find(Auth::user()->student->id)->pivot->status === 'pending' && !$event->isStudentEvent(Auth::user()->student, 'HEAD'))
                                    <p class="text-yellow-500 text-lg font-semibold pt-5">Your request is pending.</p>
                                @endif
                            @endauth
                        </p>
                        <p>
                            @auth
                                @if(!Auth::user()->isRole('STUDENT') || (Auth::user()->isRole('STUDENT') && $event->isStudentEvent(Auth::user()->student, 'HEAD')) && $event->event_approval_status === 'approved')
                                    <p class="text-lg text-green-500">Status: {{ $event->event_approval_status }}
                                @elseif(!Auth::user()->isRole('STUDENT') || (Auth::user()->isRole('STUDENT') && $event->isStudentEvent(Auth::user()->student, 'HEAD')) && $event->event_approval_status === 'pending')
                                    <p class="text-lg text-orange-500">Status: {{ $event->event_approval_status }}
                                 @endif
                             @endauth
                        </p>
                        @auth
                            @if ($event->event_approval_status !== 'approved')
                                @if (Auth::user()->isRole('ADMIN') || (Auth::user()->isRole('STUDENT') && $event->isStudentEvent(Auth::user()->student, 'HEAD')))
                                <!-- DELETE EVENT BUTTON-->
                                    <form action="{{ route('events.destroy', ['event' => $event]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to DELETE THIS EVENT?')"
                                            class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Delete</button>
                                    </form>
                                @endif
                            @endif 
                        @endauth
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                <h1 class="text-center text-gray-300 py-10">No Event</h1>
            </div>
    @endif

    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/data-replacer.js') }}"></script>
@endsection