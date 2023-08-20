@extends('layouts.main')
@section('content')
    <div class="">
        <div class="">
            <div class="mx-20 mt-10">
                <h1 class="text-2xl">รายละเอียดกิจกรรม</h1>
            </div>

            <div class="mx-20 my-5 object-cover">
                <img src="{{ asset('storage/' . $event->event_image) }}"
                    class="rounded-lg w-full h-[70vh]">
            </div>
        </div>
        <div class=" m-32 mt-10">
            <div class="flex flex-inline space-x-4">

                <ul class="flex p-2 pl-0 mb-5">
                    <li class="flex bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded"><i
                            class="fa-solid fa-crown pt-1 text-center mr-2 "
                            style="color: black;"></i>{{ $event->students()->byRoleEvent('HEAD')->first()->user->username }}</li>

                    <li id="status"
                        class="bg-{{ $event->event_approval_status === 'pending' ? 'gray-100' : ($event->event_approval_status === 'approved' ? 'green' : '#FF6666') }} p-1 pl-3 pr-3 mr-5 rounded">
                        {{ $event->event_approval_status }}
                    </li>

                    @if (Auth::check() && Auth::user()->byRole('STUDENT'))
                    @if ($event->students()->byRoleEvent('HEAD')->where('user_id', Auth::user()->id)->exists() || 
                        $event->students()->byRoleEvent('STAFF')->where('user_id', Auth::user()->id)->exists())
                    <a href="{{ route('events.kanbans.show', ['event' => $event]) }}" class="p-1 pl-3 pr-3 mr-5">
                        Manage Event
                    </a>
                    @endif
                    @endif
                </ul>
            </div>
            <pre class="flex text-gray-700 leading-tight mb-4 break-all overflow-auto">{{ $event->event_description }}</pre>
            <div class="flex justify-between items-cente my-5">
                <div class="flex items-center">
                    <img src="{{ asset('/storage/' . $event->students()->byRoleEvent('HEAD')->first()->user_profile_img) }}" alt="Avatar"
                        class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold">{{ $event->students()->byRoleEvent('HEAD')->first()->user->user_firstname}} {{ $event->students()->byRoleEvent('HEAD')->first()->user->user_lastname}}</span>
                </div>
                <div class="">
                    <h1>จำนวนคนรับสมัคร {{ $event->event_participant }} / {{ $event->event_participant_limit }}</h1>
                    <p class="text-gray-600">{{ $event->event_date }} </p>
                    <p class="text-gray-600">{{ $event->event_application_deadline }}</p>
                </div>
                <div class="flex mt-20 justify-end">
                    <button type="submit"
                        class="bg-[#F6D106] p-1 pl-5 pr-5 mr-5 rounded transition-all hover:opacity-80">สมัครเข้าร่วม</button>
                    <button type="submit"
                        class="bg-[#FF6666] p-1 pl-7 pr-7 mr-5 rounded transition-all hover:opacity-80">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
@endsection
