@extends('layouts.main')
@section('content')
    @include('layouts.subviews.navbar-staff')
    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">

        <div class="flex justify-center p-20 pt-0 mt-40">
            <div class="flex flex-col bg-gray-1000 w-3/5 mr-5">
                <h1>Staff List</h1>
                @if (!$event->getStaff('approved')->isEmpty())
                    @foreach ($students as $student)
                        @if (
                            $event->students()->where('student_id', $student->id)->first()->pivot->role != 'HEAD' &&
                                $event->students()->where('student_id', $student->id)->first()->pivot->role == 'STAFF')
                            <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                                <div class="flex items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2 object-cover">
                                    <span
                                        class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname }}</span>

                                    <!-- Delete Button -->
                                    <form action="{{ route('detach', ['event' => $event->id, 'student' => $student->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Delete</button>
                                    </form>

                                </div>
                                <hr>
                                <div class="pt-3">
                                    <h1 class="font-semibold">{{ $student->user->user_firstname }}
                                        {{ $student->user->user_lastname }}</h1>
                                    <h1>Faculty : {{ $student->faculty }}</h1>
                                    <h1>Major : {{ $student->major }}</h1>
                                    <h1>Year : {{ $student->year }}</h1>
                                    <h1>Facbook : {{ $student->facebook }}</h1>
                                    <h1>Line : {{ $student->line }}</h1>
                                    <h1>IG : {{ $student->instagram }}</h1>
                                    <h1>Status :
                                        {{ $event->students()->where('student_id', $student->id)->first()->pivot->status }}
                                    </h1>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @else
                    <div class="flex bg-white rounded-lg shadow-lg w-full p-2 items-center justify-center">
                        <h1 class="text-center text-gray-300 py-10">No Staffs</h1>
                    </div>
                @endif
            </div>
            <div class="w-1/2">
                <h1>Add Staff by Username</h1>
                <ul class="flex flex-col w-full">
                    <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                        <form action="{{ route('events.addStaff', ['event' => $event->id]) }}" method="POST">
                            @csrf
                            <label class="p-3">Enter username:</label>
                            <input type="text" id="username" name="username" class="border p-2 rounded-lg mb-3"
                                required>
                            <input type="submit"
                                class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2 mt-3">
                        </form>
                        @if (session('error'))
                            <p class="text-red-500 mt-2">{{ session('error') }}</p>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
    @endsection
