<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center">
        <a href="{{ route('events.kanbans.show', ['event' => $event]) }}"
            class="inline-block p-6 pb-2 {{ request()->routeIs('events.kanbans.show') ? 'text-purple-600 border-b-4 border-purple-600' : 'border-b-4 border-transparent hover:text-gray-600 hover:border-gray-300' }} rounded-t-lg active text-base transition">
            Kanban Board
        </a>
        <a href="{{ route('events.manage.applicants', ['event' => $event]) }}"
            class="inline-block p-6 pb-2 {{ request()->routeIs('events.manage.applicants') ? 'text-purple-600 border-b-4 border-purple-600' : 'border-b-4 border-transparent hover:text-gray-600 hover:border-gray-300' }} rounded-t-lg text-base">
            Participants
        </a>
        <a href="{{ route('events.manage.staffs', ['event' => $event]) }}"
            class="inline-block p-6 pb-2 {{ request()->routeIs('events.manage.staffs') ? 'text-purple-600 border-b-4 border-purple-600' : 'border-b-4 border-transparent hover:text-gray-600 hover:border-gray-300' }} rounded-t-lg text-base">
            Event Creator
        </a>
    </ul>
</div>