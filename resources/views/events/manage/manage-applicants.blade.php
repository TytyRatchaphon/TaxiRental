@extends('layouts.main')
@section('content')
@include('layouts.subviews.navbar-staff')
    <div class="flex justify-center p-20 pt-0">
        <div class="flex flex-col bg-gray-1000 w-3/5 mr-5">
            <h1>Participants</h1>
            @foreach ($students as $student)
                @if (
                    $event->students()->where('student_id', $student->id)->first()->pivot->role != 'HEAD' &&
                        $event->students()->where('student_id', $student->id)->first()->pivot->status == 'approved')
                    <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                        <div class="flex items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                                class="w-8 h-8 rounded-full mr-2 object-cover">
                            <span class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname }}</span>


                            <!-- Approve Button -->
                            <form action="{{ route('approve', ['event' => $event->id, 'student' => $student->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Approve</button>
                            </form>

                            <!-- Reject Button -->
                            <form action="{{ route('reject', ['event' => $event->id, 'student' => $student->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Reject</button>
                            </form>

                        </div>
                        <hr>
                        <div class="pt-3">
                            <h1 class="font-semibold">{{ $student->user->user_firstname }} {{ $student->user->user_lastname }}</h1>
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
                @endif
            @endforeach
            </ul>
        </div>
        <div class="w-1/2">
            <h1>Pending Participants</h1>
            <ul class="flex flex-col w-full">
                @foreach ($students as $student)
                    @if (
                        ($event->students()->where('student_id', $student->id)->first()->pivot->role != 'HEAD' &&
                            $event->students()->where('student_id', $student->id)->first()->pivot->status == 'pending') ||
                            $event->students()->where('student_id', $student->id)->first()->pivot->status == 'unapproved')
                        <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                            <div class="flex items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                                    class="w-8 h-8 rounded-full mr-2 object-cover">
                                <span class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname }}</span>


                                <!-- Approve Button -->
                                <form action="{{ route('approve', ['event' => $event->id, 'student' => $student->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Approve</button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('reject', ['event' => $event->id, 'student' => $student->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">Reject</button>
                                </form>

                            </div>
                            <hr>
                            <div class="pt-3">
                                <h1 class="font-semibold">{{ $student->user->user_firstname }}
                                    {{ $student->user->user_lastname }}</h1>
                                <h1>Faculty : {{ $student->faculty }} Major : {{ $student->major }} Year :
                                    {{ $student->year }}
                                </h1>
                                <h1>Facbook : {{ $student->facebook }}</h1>
                                <h1>Line : {{ $student->line }}</h1>
                                <h1>IG : {{ $student->instagram }}</h1>
                                <h1 class="bg-red-200 w-[22vh] py-1 mt-3 text-center rounded-lg">Status :
                                    {{ $event->students()->where('student_id', $student->id)->first()->pivot->status }}
                                </h1>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection
