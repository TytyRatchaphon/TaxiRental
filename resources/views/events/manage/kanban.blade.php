@extends('layouts.main')
@section('content')
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center bg-gray-100">
        <a href={{ url('/events/event/kanban') }} class="inline-block p-6 pb-2 text-purple-600 border-b-4 border-purple-600 rounded-t-lg active text-base">คัมบังบอร์ด</a>
        <a href={{ url('/events/event/manage/applicants') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้เข้าร่วมกิจกรรม</a>
        <a href={{ url('/events/event/manage/staffs') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้จัดกิจกรรม</a>
        <a href={{ url('/events/event/manage/budgets') }} class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ขอเบิกงบประมาณ</a>
    </ul>
</div>
<div class="flex flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <img src="{{ $event->event_image }}" alt="event_image" class="w-full h-64 object-cover">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->event_name }}</h2>
            <p class="text-gray-700 leading-tight mb-4">
                {{ $event->event_description }}
            </p>
            <a href={{ url('/events/show') }}>เพิ่มเติม...</a>
            <div class="flex justify-between items-center mt-5">
                <div class="flex items-center">
                    @foreach($event->users as $user)
                        @if($user->is_head_event)
                        <img src="{{ $user->user_profile_image }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                        <span class="text-gray-800 font-semibold">{{ $user->username }}</span>
                        @endif
                    @endforeach
                </div>
                <span class="text-gray-600">{{ $event->event_date }}</span>
            </div>
        </div>
    </div>
</div>
<div class="flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex flex-col bg-white">
        <form action="{{ route('kanbans.store', ['event' => $event]) }}" method="post">
            @csrf
            <h1>เพิ่มคัมบังบอร์ดของคุณ</h1>
            <div class="flex justify-center items-center p-5">
                <label for="title">หัวเรื่อง</label>
                <input id="title" name="title" type="text" class="w-full">
                <label for="date_deadline">Deadline</label>
                <input id="date_deadline" name="date_deadline" type="date" class="w-full">
            </div>
            <div class="flex justify-center items-center p-5">
                <label for="detail">รายละเอียด</label>
                <input id="detail" name="detail" type="text" class="w-full">
            </div>
            <button type="submit">เพิ่มกิจกรรม</button>
        </form>
    </div>
    @for($i = 0; $i < 3; $i++)
    <div class="flex mb-5">
        <ul class="flex-col p-5 mr-3 w-64">
            <div class="flex-col items-center justify-end mb-5">
                <h1 class="text-xl font-sans pr-3">{{ $statusOptions[$i]->value }}</h1>
            </div>
            @foreach($event->kanbans as $kanban)
                @if($kanban->status === $statusOptions[$i]->value)
                <li class="flex-col bg-white shadow-lg mb-3 w-64">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $kanban->title }}</h2>
                        <p class="text-gray-700 leading-tight mb-4">
                            {{ $kanban->detail }}
                        </p>
                        <div class="flex justify-between items-center">
                            <h1>{{ $kanban->status }}</h1>
                            <span class="text-gray-600">{{ $kanban->date_deadline }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <form action="{{ route('kanbans.update', ['kanban' => $kanban]) }}" method="POST" id="statusForm">
                                @csrf
                                @method('PUT')
                                <select name="status" id="status" autocomplete="status" onchange="submitForm()">
                                    @foreach($statusOptions as $statusOption)
                                    <option value="{{ $statusOption }}" id="status">{{ $statusOption }}</option>
                                    @endforeach
                                </select>
                            </form>
                            <form action="{{ route('kanbans.destroy', ['kanban' => $kanban]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit">ลบเนื้อหา</button>
                            </form>
                        </div>
                    </div>
                </li>
                @endif
            @endforeach
        </ul>
        @endfor
    </div>
</div>
<script>
    function submitForm() {
        document.getElementById("statusForm").submit();
    }
</script>
@endsection
