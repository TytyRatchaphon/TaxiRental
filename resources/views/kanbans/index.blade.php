@extends('layouts.main')
@section('content')
@include('layouts.subviews.navbar-staff')
<div class="p-10">
    <div class="flex-col justify-center items-center px-24 py-5">
        <!-- Create new Kanban -->
        @can('createKanban', $event)
        <form action="{{ route('events.kanbans.store', ['event' => $event]) }}" method="post" class="px-20">
            @csrf
            <h1 class="text-center text-xl font-semibold">Add Post-it</h1>
            <div class="flex w-full py-5">
                <div class="w-8/12 pr-10">
                    <label for="title" class="font-semibold mr-5">Title</label>
                    <input id="title" name="title" type="text" placeholder="Enter title of your kanban"
                        class="@error('title') border-red-600 @enderror w-full">
                    @error('title')
                    <div class="text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="w-4/12">
                    <label for="date_deadline" class="font-semibold">
                        Deadline between {{ today()->format('d-M-Y') }} to
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('d-M-Y') }}
                    </label>
                    <input id="date_deadline" name="date_deadline" type="date"
                        class="@error('date_deadline') border-red-600 @enderror w-full">
                    @error('date_deadline')
                    <div class="text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="justify-center items-center">
                <label for="detail" class="font-semibold">Detail</label>
                <input id="detail" name="detail" type="text" placeholder="Enter detail of your kanban"
                    class="@error('title') border-red-600 @enderror w-full">
                @error('detail')
                <div class="text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-yellow-300 rounded-lg m-10 py-2 px-10 font-semibold hover:opacity-80">Add</button>
            </div>
        </form>
        @endcan
    </div>
    <div = class="border-2 shadow-lg rounded-xl pt-10">
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
            @for ($i = 0; $i < 3; $i++)
            <ul class="m-5 p-7 w-1/3 rounded-lg h-screen overflow-auto
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
                        @can('updateKanban', $event)
                        <form
                            action="{{ route('events.kanbans.update-status', ['event' => $event, 'kanban' => $kanban]) }}"
                            method="POST" id="statusForm" class="flex justify-between items-center pt-10 pb-5">
                            @csrf
                            @method('PUT')
                            @foreach ($statusOptions as $statusOption)
                            <button type="submit" id="status" name="status" value="{{ $statusOption }}"
                                class="@if ($kanban->status == $statusOption->value)
                                    bg-yellow-400 text-black @else border-yellow-400 border-2 hover:bg-yellow-400 @endif rounded-xl px-3 mr-2"
                                onclick="return confirm('Are you sure you want to update {{$statusOption}} status?')">
                                {{ $statusOption }}
                            </button>
                            @endforeach
                        </form>
                        @endcan
                        <!-- Delete Kanban -->
                        @can('deleteKanban', $event)
                        <form action="{{ route('events.kanbans.destroy', ['event' => $event, 'kanban' => $kanban]) }}"
                            method="POST" class="flex justify-end items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-400 text-white rounded-full px-3 hover:opacity-90"
                                onclick="return confirm('Are you sure you want to delete this post it?')">
                                DELETE
                            </button>
                        </form>
                        @endcan
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
    </div>
</div>
@endsection