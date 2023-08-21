<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex justify-center items-center">
        <a href="{{ route('events.kanbans.show', ['event' => $event]) }}"
            class="inline-block p-6 pb-2 text-purple-600 border-b-4 border-purple-600 rounded-t-lg active text-base transition">
            Kanban Board
        </a>
        <a href="{{ route('events.manage.applicants', ['event' => $event]) }}"
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">
            Participants
        </a>
        <a href="{{ url('/events/event/manage/staffs') }}"
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">
            Event Creator
        </a>
        <a href="{{ url('/events/event/manage/budgets') }}"
            class="inline-block p-6 pb-2 border-b-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 text-base">
            Budget
        </a>
    </ul>
</div>