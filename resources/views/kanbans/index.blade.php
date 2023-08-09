@extends('layouts.main')
@section('content')
<!-- Select manage page -->
<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center bg-gray-100">
        <a href="{{ route("events.kanbans.show", ['event' => $event]) }}"
            class="inline-block p-6 pb-2 text-purple-600 border-b-4 border-purple-600 rounded-t-lg active text-base">คัมบังบอร์ด</a>
        <a href={{ url('/events/event/manage/applicants') }}
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้เข้าร่วมกิจกรรม</a>
        <a href={{ url('/events/event/manage/staffs') }}
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ผู้จัดกิจกรรม</a>
        <a href={{ url('/events/event/manage/budgets') }}
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">ขอเบิกงบประมาณ</a>
    </ul>
</div>

<!-- What Event? -->
<div class="flex flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <img src="{{ $event->event_image }}" alt="event_image" class="w-full h-64 object-cover">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->event_name }}</h2>
            <p class="text-gray-700 leading-tight mb-4">
                {{ $event->event_description }}
            </p>
            <a href="{{ route("events.show", ['event' =>$event]) }}">เพิ่มเติม...</a>
            <div class="flex justify-between items-center mt-5">
                <span class="text-gray-600">Event Start: {{ $event->event_date }}</span>
            </div>
        </div>
    </div>
</div>

<div class="flex-col justify-center items-center bg-gray-100 p-7">
    <div class="flex flex-col bg-white">

        <!-- Create new Kanban -->
        <form action="{{ route('events.kanbans.store', ['event' => $event]) }}" method="post">
            @csrf
            <h1>เพิ่มคัมบังบอร์ดของคุณ</h1>
            <div class="flex justify-center items-center p-5">
                <label for="title">หัวเรื่อง</label>
                @error('title')
                <div class="text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <input id="title" name="title" type="text" class="@error('title') border-red-600 @enderror w-full">

                <label for="date_deadline">Deadline</label>
                @error('date_deadline')
                <div class="text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <input id="date_deadline" name="date_deadline" type="date"
                    class="@error('date_deadline') border-red-600 @enderror w-full">
            </div>
            <div class="flex justify-center items-center p-5">
                <label for="detail">รายละเอียด</label>
                @error('detail')
                <div class="text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <input id="detail" name="detail" type="text" class="@error('title') border-red-600 @enderror w-full">
            </div>
            <div>
                <button type="submit">เพิ่มกิจกรรม</button>
            </div>
        </form>
    </div>

    <!-- Check Kanban empty? -->
    @if(!$event->kanbans->isEmpty())
    @for($i = 0; $i < 3; $i++) <div class="flex mb-5">
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
                            <span class="text-gray-600">{{ $kanban->date_deadline }}</span>
                        </div>
                        <div class="flex justify-between items-center">

                            <!-- update Kanban Status -->
                            <form
                                action="{{ route('events.kanbans.update-status', ['event' => $event, 'kanban' => $kanban]) }}"
                                method="POST" id="statusForm">
                                @csrf
                                @method('PUT')
                                @foreach($statusOptions as $statusOption)
                                <button type="submit" id="status" name="status" value="{{ $statusOption }}"
                                    class="@if($kanban->status == $statusOption->value) bg-red-600 @endif shadow-lg">
                                    {{ $statusOption }}
                                </button>
                                @endforeach
                            </form>

                            <!-- Delete Kanban -->
                            <form action="{{ route('events.kanbans.destroy', ['event' => $event,'kanban' => $kanban]) }}"
                                method="POST">
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
        @else
        <div>
            <h1>
                Not have Kanbans in This Event
            </h1>
        </div>
        @endif
</div>
</div>
<script>
function submitForm() {
    document.getElementById("statusForm").submit();
}
</script>
@endsection