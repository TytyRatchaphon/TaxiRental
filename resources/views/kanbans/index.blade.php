@extends('layouts.main')
@section('content')
@include('layouts.subviews.navbar-staff')
<div class="p-10">
    <div class="flex justify-between mx-10 w-full">
        <div class="ml-5 w-1/3">
            <h1 class="text-xl font-sans pr-3">Not Start</h1>
        </div>
        <div class="w-1/3">
            <h1 class="text-xl font-sans pr-3">In Progress</h1>
        </div>
        <div class="w-1/3">
            <h1 class="text-xl font-sans pr-3">Success</h1>
        </div>
    </div>
    <div class="flex justify-between px-5 w-full">
        <!-- Check Kanban empty? -->
        @for ($i = 0; $i < 3; $i++) <ul class="m-5 p-7 w-1/3 rounded-lg h-screen overflow-auto
        @if($statusOptions[$i]->value == 'Not Start')
            bg-red-100
        @elseif($statusOptions[$i]->value == 'In Progress')
            bg-yellow-100
        @elseif($statusOptions[$i]->value == 'Success')
            bg-green-100
        @endif">
            @if(!$event->kanbans()->byStatus($statusOptions[$i]->value)->get()->isEmpty())
            @foreach ($event->kanbans()->byStatus($statusOptions[$i]->value)->get() as $kanban)
            <li class="flex-col bg-white shadow-lg mb-3 p-3">
                <div class="p-6">
                    <h2 class="font-bold text-gray-800 mb-2">{{ $kanban->title }}</h2>
                    <p class="text-gray-700 leading-tight mb-4">
                        {{ $kanban->detail }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">{{ $kanban->date_deadline }}</span>
                    </div>
                    <!-- update Kanban Status -->
                    <div class="flex justify-between my-3">
                        <form
                            action="{{ route('events.kanbans.update-status', ['event' => $event, 'kanban' => $kanban]) }}"
                            method="POST" id="statusForm">
                            @csrf
                            @method('PUT')
                            @foreach ($statusOptions as $statusOption)
                            <button type="submit" id="status" name="status" value="{{ $statusOption }}"
                                class="@if ($kanban->status == $statusOption->value)
                                    bg-black text-yellow-400 @else border-yellow-400 border-2 hover:bg-yellow-400 @endif rounded-xl px-3 mr-2">
                                {{ $statusOption }}
                            </button>
                            @endforeach
                        </form>
                        <!-- Delete Kanban -->
                        <form action="{{ route('events.kanbans.destroy', ['event' => $event, 'kanban' => $kanban]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-400 text-white rounded-full px-3 hover:opacity-90">DELETE</button>
                        </form>
                    </div>

                </div>
            </li>
            @endforeach
            @else
            <li class="flex-col bg-white shadow-lg mb-3 p-5">
                <h1 class="items-center">Nothing in {{ $statusOptions[$i]->value }}</h1>
            </li>
            @endif
            </ul>
            @endfor
    </div>
    <div class="flex-col justify-center items-center">
        <!-- Create new Kanban -->
        <form action="{{ route('events.kanbans.store', ['event' => $event]) }}" method="post"
            class="p-5 mx-20 my-5">
            @csrf
            <h1 class="text-center text-xl font-semibold">Add new Kanban</h1>
            <div class="flex justify-center items-center w-full pt-5">
                <div class="w-8/12 pr-5">
                    <label for="title" class="font-semibold mr-5">Title</label>
                    @error('title')
                    <div class="text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                    <input id="title" name="title" type="text" placeholder="Enter title of your kanban"
                        class="@error('title') border-red-600 @enderror w-full">
                </div>
                <div class="w-3/12">
                    <label for="date_deadline" class="font-semibold">Deadline</label>
                    @error('date_deadline')
                    <div class="text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                    <input id="date_deadline" name="date_deadline" type="date"
                        class="@error('date_deadline') border-red-600 @enderror w-full">
                </div>
            </div>
            <div class="justify-center items-center p-5 mx-5">
                <label for="detail" class="font-semibold">Detail</label>
                @error('detail')
                <div class="text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <input id="detail" name="detail" type="text" placeholder="Enter detail of your kanban"
                    class="@error('title') border-red-600 @enderror w-full">
            </div>
            <div class="text-center m-5">
                <button type="submit" class="bg-yellow-300 rounded-lg p-2 px-5 hover:opacity-80">เพิ่มเนื้อหา</button>
            </div>
        </form>
    </div>
</div>
@endsection