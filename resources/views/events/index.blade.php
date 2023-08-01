@extends('layouts.main')
@section('content')
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center bg-gray-100">
        <a href="#" class="inline-block p-8 pb-3 pt text-purple-600 border-b-2 border-purple-600 rounded-t-lg active">ทั้งหมด</a>
        <a href="#" class="inline-block p-8 pb-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 ">กิจกรรมของฉัน</a>
        <a href="#" class="inline-block p-8 pb-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">ดำเนินการอยู่</a>
        <a href="#" class="inline-block p-8 pb-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">สำเร็จแล้ว</a>
    </ul>
</div>
<ul class="flex flex-col justify-center items-center bg-gray-100 p-10 pb-7">
    <li class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606" alt="Mountain" class="w-full h-64 object-cover">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Beautiful Mountain View</h2>
            <p class="text-gray-700 leading-tight mb-4">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu sapien porttitor, blandit velit ac,
                vehicula elit. Nunc et ex at turpis rutrum viverra.
            </p>
            <a href={{ url('/events/show') }}>เพิ่มเติม...</a>
            <div class="flex justify-between items-center mt-5">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                    <span class="text-gray-800 font-semibold">John Doe</span>
                </div>
                <span class="text-gray-600">2 hours ago</span>
            </div>
        </div>
    </li>
</ul>
@endsection
