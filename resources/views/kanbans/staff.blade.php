<!-- What Event? -->
<div class="flex flex-col justify-center items-center p-7">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <img src="{{ asset('/storage/' . $event->event_image) }}" class=" w-96" alt="...">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->event_name }}</h2>
            <p class="text-gray-700 leading-tight mb-4 ">{{ Str::limit($event->event_description, 60, '...') }}</p>
            <div class="flex justify-between items-center mt-5">
                <span class="text-gray-600">Event Start: {{ $event->event_date }}</span>
            </div>
            <div>
                <a href="{{ route('events.show', ['event' => $event]) }}"
                    class="transition-all hover:text-[#F6D106]">More Detail...</a>
            </div>
        </div>
    </div>
</div>