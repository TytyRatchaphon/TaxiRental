<?php

namespace App\Http\Controllers;

use App\Models\Enums\KanbanAccessibility;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index(Event $event)
    {
        $statusOptions = KanbanAccessibility::cases();

        return view('events.manage.kanban', [
            'event' => $event,
            'statusOptions' => $statusOptions,
        ]);
    }

    public function store(Request $request, Event $event)
    {
        $kanban = new Kanban();
        $kanban->title = $request->input('title');
        $kanban->detail = $request->input('detail');
        $kanban->date_deadline = $request->input('date_deadline');
        $kanban->status = 'Not Start';
        $kanban->event_id = $event->id;
        $kanban->save();

        return redirect()->route('events.index');
    }

    public function destroy(Kanban $kanban)
    {
        $kanban->delete();

        return redirect()->route('events.index');
    }

    public function update(Request $request, Kanban $kanban)
    {
        $kanban->status = $request->input('status');
        $kanban->save();

        return redirect()->route('kanbans.index');
    }

    public function show(Kanban $kanban)
    {
        return view('events.manage.kanban_show', ['kanban' => $kanban]);
    }
}
