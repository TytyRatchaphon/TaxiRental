@extends('layouts.main')
@section('content')
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
        <h1>ผู้เข้าร่วมกิจกรรมรออนุมัติ</h1>
        <ul class="flex flex-col w-full">
        @foreach($students as $student)
            <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-7 mb-5">
                <div class="flex items-center mb-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold mr-5">{{ $student->user->user_firstname}}</span>
                    <form action="{{ route('applicant.update', ['event' => $event, 'student' => $student]) }}" method="POST" id="statusForm">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="status" value="approve" class="bg-[#fde047] font-semibold transition-colors hover:opacity-80 hover:text-white rounded-lg p-1 pr-2 pl-2 mr-3">อนุมัติ</button>
                        <button type="submit" name="status" value="reject" class="bg-[#FF6666] font-semibold text-white hover:opacity-80 rounded-lg p-1 pr-2 pl-2">ไม่อนุมัติ</button>
                    </form>
                </div>
                <hr>
                <div class="pt-3">
                    <h1 class="font-semibold">{{ $student->user->user_firstname }} {{ $student->user->user_lastname}}</h1>
                    <h1>Faculty : {{ $student->faculty}} Major : {{ $student->major}} Year : {{ $student->year}}</h1>
                    <h1>Facbook : {{ $student->facebook}}</h1>
                    <h1>Line : {{ $student->line}}</h1>
                    <h1>IG : {{ $student->instagram}}</h1>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection
