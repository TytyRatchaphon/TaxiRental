@extends('layouts.main')
@section('content')
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center bg-gray-100">
        <a href={{ url('/events/event/manage/kanban') }} class="inline-block p-6 pb-2 text-purple-600 border-b-4 border-purple-600 rounded-t-lg active text-base">คัมบังบอร์ด</a>
        <a href={{ url('/events/event/manage/applicants') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้เข้าร่วมกิจกรรม</a>
        <a href={{ url('/events/event/manage/staffs') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้จัดกิจกรรม</a>
        <a href={{ url('/events/event/manage/budgets') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ขอเบิกงบประมาณ</a>
    </ul>
</div>
<div class="flex flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
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
    </div>
</div>
<div class="flex flex-col bg-white justify-center items-center">
    <h1>เพิ่มคัมบังบอร์ดของคุณ</h1>
    <div class="flex justify-center items-center">
        <h1 class="p-5 max-w-6xl w-full">หัวเรื่อง</h1>
        <input class="h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1 mr-5" type="text">
        <select id="statusKanban" name="statusKanban"
                class="h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1">
            <option value="All" selected="">กรุณาเลือก</option>
            <option value="not-start">ยังไม่เริ่ม</option>
            <option value="in-progress">กำลังดำเนินการ</option>
            <option value="success">เสร็จสิ้นแล้ว</option>
        </select>
    </div>
    <div class="flex justify-center items-center p-5 max-w-5xl">
        <label for="">รายละเอียด</label>
        <input type="text" class="w-full">
    </div>
    <input type="submit">
</div>
<div class="flex flex-col justify-center items-center bg-gray-100 p-7 w-full">
    <div class="flex max-w-5xl w-4/5 mb-5">
        <ul class="flex flex-col bg-[#FFD4D4] shadow-lg p-5 bg-black mr-5">
            <div class="flex items-center justify-end mb-5">
                <h1 class="text-xl font-sans pr-3">ยังไม่ได้เริ่ม</h1>
            </div>
            <li class="bg-white mb-3">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Beautiful Mountain View</h2>
                    <p class="text-gray-700 leading-tight mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu sapien porttitor, blandit velit ac,
                        vehicula elit. Nunc et ex at turpis rutrum viverra.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                            <span class="text-gray-800 font-semibold">John Doe</span>
                        </div>
                        <span class="text-gray-600">2 hours ago</span>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="flex flex-col bg-[#F5F0BB] shadow-lg p-5 mr-5">
            <div class="flex items-center justify-end mb-5">
                <h1 class="text-xl font-sans pr-3">กำลังดำเนินการ</h1>
            </div>
            <li class="bg-white mb-3">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Beautiful Mountain View</h2>
                    <p class="text-gray-700 leading-tight mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu sapien porttitor, blandit velit ac,
                        vehicula elit. Nunc et ex at turpis rutrum viverra.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                            <span class="text-gray-800 font-semibold">John Doe</span>
                        </div>
                        <span class="text-gray-600">2 hours ago</span>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="flex flex-col bg-[#D0F5BE] shadow-lg p-5">
            <div class="flex items-center justify-end mb-5">
                <h1 class="text-xl font-sans pr-3">เสร็จสิ้นแล้ว</h1>
            </div>
            <li class="bg-white mb-3">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Beautiful Mountain View</h2>
                    <p class="text-gray-700 leading-tight mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu sapien porttitor, blandit velit ac,
                        vehicula elit. Nunc et ex at turpis rutrum viverra.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                            <span class="text-gray-800 font-semibold">John Doe</span>
                        </div>
                        <span class="text-gray-600">2 hours ago</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
