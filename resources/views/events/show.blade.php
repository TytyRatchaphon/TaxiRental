@extends('layouts.main')
@section('content')
<div class="flex justify-center items-center bg-gray-100 p-10">
    <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl">
        <div class="object-cover">
            <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Mountain" class="w-full">
        </div>
        <div class="p-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">{{$event->event_name}}</h2>
            <ul class="flex p-2 pl-0 mb-5">
                <li class="bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded">ผู้จัดกิจกรรม</li>
                <li class="bg-[#F6D106] p-1 pl-3 pr-3 mr-5 rounded" >{{$event->event_approval_status}}</li>
                <a href={{url('/events/event/manage/kanban')}} class="p-1 pl-3 pr-3 mr-5">จัดการกิจกรรม</a>
            </ul>
            <p class="text-gray-700 leading-tight mb-4">{{$event->event_description}}</p>
            <div class="flex justify-between items-cente mb-5">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold">หัวหน้ากิจกรรม</span>
                </div>
            </div>
            <div class="">
                <h1>จำนวนคนรับสมัคร {{$event->event_participant}} / {{$event->event_participant_limit}}</h1>
                <p class="text-gray-600">{{$event->event_date}} </p>
                <p class="text-gray-600">{{$event->event_application_deadline}}</p>
            </div>
            <div class="flex mt-20 justify-end">
                <button type="submit" class="bg-[#F6D106] p-1 pl-5 pr-5 mr-5 rounded transition-all hover:opacity-80">สมัครเข้าร่วม</button>
                <button type="submit" class="bg-[#FF6666] p-1 pl-7 pr-7 mr-5 rounded transition-all hover:opacity-80">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
@endsection
