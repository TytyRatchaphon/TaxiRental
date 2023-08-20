@extends('layouts.main')
@section('content')
<div class="flex justify-center p-10">
    <div class="flex flex-col w-full mr-5">

        <div class="mb-5">
            <h1 class="text-2xl">Request Create Event</h1>
        </div>
        <div class="justify-between mb-3">
            <div class="flex items-center w-11/12">
                <div class="w-3/12">
                    <h1>Head-Event</h1>
                </div>
                <div class="w-6/12">
                    <h2>Event</h2>
                </div>
                <div class="w-2/12 text-center">
                    <h2>Expense Amount</h2>
                </div>
                <div class="w-2/12 text-center">
                    <h2>Staffs Limit</h2>
                </div>
            </div>
        </div>
        @if(!$events->isEmpty())
        <ul class="flex-col items-center">
            @foreach($events as $event)
            <li class="flex mb-3">
                <a href="{{ route('events.show', ['event' => $event]) }}"
                    class="flex bg-white rounded-lg shadow-lg hover:opacity-80 w-11/12 p-3 items-center">
                    <div class="flex items-center w-3/12">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                            class="w-8 h-8 rounded-full mr-2 object-cover">
                        <span class="text-gray-800 font-semibold">{{ $event->students()->byRoleEvent('HEAD')->user->username }}</span>
                    </div>
                    <div class="w-6/12">
                        <h1>{{ $event->event_name }}</h1>
                    </div>
                    <div class="w-2/12 text-center">
                        <h1>{{ $event->event_expense_amount}}</h1>
                    </div>
                    <div class="w-2/12 text-center">
                        <h1>{{ $event->event_staffs_limit}}</h1>
                    </div>
                </a>
                <form id="statusForm" action="{{ route('events.change-status', ['event' => $event]) }}" method="post"
                    class="flex ml-5 items-center justift-center">
                    @csrf
                    @method('PUT')
                    <button type="submit" value="approved" name="status"
                        class="bg-yellow-300 rounded-full px-4 py-1 mr-2 hover:opacity-90 hover:text-white">A</button>
                    <button type="submit" value="rejected" name="status"
                        class="bg-red-400 rounded-full px-4 py-1 hover:opacity-90 hover:text-white">R</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
        <div class="flex bg-white rounded-lg shadow-lg w-11/12 p-3 items-center justify-center">
            <h1 class="text-center text-gray-300 py-10">Not have pending Event</h1>
        </div>
        @endif
    </div>
</div>
@endsection