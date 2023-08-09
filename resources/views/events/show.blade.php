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
            <div class=" m-32 mt-10">
                <div class="flex flex-inline space-x-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $event->event_name }}</h2>
                    <ul class="flex p-2 pl-0 mb-5">
                        <li class="bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded">Event Creator</li>
                        <li class="bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded">{{ $event->event_approval_status }}</li>
                        <a href="{{ route('kanbans.index', ['event' => $event]) }}" class="p-1 pl-3 pr-3 mr-5">Manage Event</a>
                    </ul>
                </div>

                <p class="text-gray-700 leading-tight mb-4">{{ $event->event_description }}</p>
                <div class="flex justify-between items-cente mb-5">
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                            class="w-8 h-8 rounded-full mr-2 object-cover">
                        <span class="text-gray-800 font-semibold">หัวหน้ากิจกรรม</span>
                    </div>
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
