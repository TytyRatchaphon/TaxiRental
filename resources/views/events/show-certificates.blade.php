@extends('layouts.main')
@section('content')
<div class="p-5">
    <ul class="flex flex-col justify-center items-center">
        @if(!$events->isEmpty())
            @foreach($events as $event)
            <li class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl w-full mb-5">
                <div class="p-7">
                    <div class="flex justify-between">
                        <h1 class="text-xl leading-tight font-semibold mb-2">{{ $event->event_name }}</h1>
                        <p class="text-gray-700 leading-tight">
                            {{ $event->event_date }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('events.show', ['event' => $event]) }}">See more</a>
                    </div>
                </div>
                <hr>
                @if($event->certificate)
                    <div class="object-cover m-20 mt-5 mb-5">
                        <img src="{{ assert('storage/'.$event->certficate->path_img) }}" alt="certficate"
                            class="rounded-lg w-full alsolute">
                    </div>
                @else
                    <div class="object-cover m-20 mt-5 mb-5">
                        <p>This event have not Certficate!</p>
                    </div>
                @endif
            </li>
            @endforeach
        @else
            <h1>nothing</h1>
        @endif
    </ul>
</div>
@endsection