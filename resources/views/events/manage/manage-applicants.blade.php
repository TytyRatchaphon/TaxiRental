@extends('layouts.main')
@section('content')
    @include('layouts.subviews.navbar-staff')
    <div class="flex justify-center p-10 text-center">
        <div class="flex flex-col bg-gray-1000 w-3/5 mr-5">
            <h1>Participants</h1>
            @if (!$event->getApplicant('approved')->isEmpty())
                @foreach ($event->getApplicant('approved') as $student)
                    <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                        <div class="flex items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                                class="w-8 h-8 rounded-full mr-2 object-cover">
                            <span class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname }}</span>

                            <!-- Delete Button -->
                            <form action="{{ route('detach', ['event' => $event->id, 'student' => $student->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Delete</button>
                            </form>

                        </div>
                        <hr>
                        <div class="pt-3 text-left">
                            <h1 class="font-semibold">{{ $student->user->user_firstname }}
                                {{ $student->user->user_lastname }}</h1>
                            <h1>Faculty : {{ $student->faculty }}</h1>
                            <h1>Major : {{ $student->major }}</h1>
                            <h1>Year : {{ $student->year }}</h1>
                            <h1>Facbook : {{ $student->facebook }}</h1>
                            <h1>Line : {{ $student->line }}</h1>
                            <h1>IG : {{ $student->instagram }}</h1>
                            <h1 class="bg-green-200 w-[22vh] py-1 mt-3 text-center rounded-lg">Status :
                                {{ $event->students()->where('student_id', $student->id)->first()->pivot->status }}
                            </h1>
                        </div>
                    </li>
                @endforeach
            @else
                <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                    <h1 class="text-center text-gray-300 py-10">No Participants</h1>
                </div>
            @endif
            </ul>
        </div>
        <div class="w-1/2 text-center">
            <h1>Pending Participants</h1>
            <ul class="flex flex-col w-full">
                @if (!$event->getApplicant('pending')->isEmpty())
                    @foreach ($event->getApplicant('pending') as $student)
                        <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                            <div class="flex items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                                    class="w-8 h-8 rounded-full mr-2 object-cover">
                                <span class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname }}</span>

                                <div class="flex flex-row space-x-3">
                                    <!-- Approve Button -->
                                    <form
                                        action="{{ route('approve', ['event' => $event->id, 'student' => $student->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Approve</button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form
                                        action="{{ route('reject', ['event' => $event->id, 'student' => $student->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Reject</button>
                                    </form>
                                </div>

                            </div>
                            <hr>
                            <div class="pt-3 text-left">
                                <h1 class="font-semibold">{{ $student->user->user_firstname }}
                                    {{ $student->user->user_lastname }}</h1>
                                <h1>Faculty : {{ $student->faculty }}</h1>
                                <h1>Major : {{ $student->major }}</h1>
                                <h1>Year : {{ $student->year }}</h1>
                                <h1>Facbook : {{ $student->facebook }}</h1>
                                <h1>Line : {{ $student->line }}</h1>
                                <h1>IG : {{ $student->instagram }}</h1>
                                <h1 class="bg-red-200 w-[22vh] py-1 mt-3 text-center rounded-lg">Status :
                                    {{ $event->students()->where('student_id', $student->id)->first()->pivot->status }}
                                </h1>
                            </div>
                        </li>
                    @endforeach
                @else
                    <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                        <h1 class="text-center text-gray-300 py-10">No Participants Pending</h1>
                    </div>
                @endif
            </ul>
        </div>
    </div>
@endsection
