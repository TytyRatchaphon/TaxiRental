@extends('layouts.main')
@section('content')
<div class="flex justify-center p-10">
    <div class="flex flex-col w-full mr-5">
        <div class="mb-5">
            <h1 class="text-2xl">Notification</h1>
        </div>
        @if(!$notifications->isEmpty())
        <ul class="flex-col items-center">
            @foreach($notifications as $notification)
            <a href="{{ route('events.show', ['event' => App\Models\Event::find($notification->data['event_id'])]) }}">

            <li class="notification bg-white rounded-lg shadow-lg mb-5 p-7 items-center">
                <h1 class="font-bold">{{ $notification->data['message'] }}</h1>
                <p>{!! $notification->data['details'] !!}</p>
            </li>
            </a>
            @endforeach
        </ul>
        @else
        <div class="flex bg-white rounded-lg shadow-lg w-11/12 mb-5 p-5 items-center justify-center">
            <h1 class="text-center text-gray-300 py-10">Not have Notification</h1>
        </div>
        @endif
        {{ $notifications->links() }}
    </div>
</div>
@endsection