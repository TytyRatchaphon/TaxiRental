@extends('layouts.main')
@section('content')
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center bg-gray-100">
        <a href={{ url('/events/event/manage/kanban') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">คัมบังบอร์ด</a>
        <a href="{{ route('events.manage.applicants', ['event'=> $event]) }}" class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้เข้าร่วมกิจกรรม</a>
        <a href="{{ url('/events/event/manage/staffs') }}" class="inline-block p-6 pb-2 text-purple-600 border-b-4 border-purple-600 rounded-t-lg active text-base">ผู้จัดกิจกรรม</a>
        <a href="{{ route('events.manage.budgets', ['event'=> $event]) }}" class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ขอเบิกงบประมาณ</a>
    </ul>
</div>
<div class="flex flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <img src="{{ asset('storage/' . $event->event_image) }}" alt="Mountain" class="w-full h-64 object-cover">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->event_name}}</h2>
            <p class="text-gray-700 leading-tight mb-4">{{ $event->event_description}}</p>
            <a href={{ url('/events/show') }}>เพิ่มเติม...</a>
            <div class="flex justify-between items-center mt-5">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold">John Doe</span>
                </div>
                <span class="text-gray-600">2 hours ago</span>
            </div>
        </div>
    </div>
</div>
<div class="flex justify-center p-20 pt-0">
    <div class="flex flex-col bg-gray-1000 w-3/5 mr-5">
        <h1>ผู้เข้าร่วมกิจกรรม</h1>
        <ul class="flex flex-col">
            <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold mr-5">John Doe</span>
                    <button class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">ยกเลิก</button>
                </div>
                <hr>
                <div class="pt-3">
                    <h1 class="font-semibold">ชื่อเล่น-ชื่อ-นามสกุล</h1>
                    <h1>คณะ-สาขาวิชา ชั้นปีที่ X</h1>
                    <h1>Facbook</h1>
                    <h1>Line</h1>
                    <h1>IG</h1>
                </div>
            </li>
        </ul>
    </div>
    <div class="w-1/2">
        <h1>เพิ่มผู้จัดกิจกรรม</h1>
        <ul class="flex flex-col w-full">
            <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                <label class="p-3">กรุณากรอกชื่อผู้ใช้ (Username)</label>
                <input type="text">
                <input type="submit" class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2 mt-3">
            </div>
        </ul>
    </div>
</div>
@endsection
