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
                    </div>
                    <hr>
                    <div class="object-cover m-20 mt-5 mb-5">
                    <img src="{{ asset('storage/'.$event->event_certificate_image) }}" alt="certficate"
                        class="rounded-lg w-full alsolute">
                    </div>
                </li>
            @endforeach
        @else
            <div class="flex bg-white rounded-lg shadow-lg w-full p-3 items-center justify-center">
                <h1 class="text-center text-gray-300 py-10">No Certificates</h1>
            </div>
        @endif
    </ul>
</div>
@endsection