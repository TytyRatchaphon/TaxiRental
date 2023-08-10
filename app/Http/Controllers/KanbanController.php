<?php

namespace App\Http\Controllers;

use App\Models\Enums\KanbanAccessibility;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function showKanbans(Event $event) {
        $statusOptions = KanbanAccessibility::cases();
        return view('kanbans.index', [
            'event' => $event,
            'statusOptions' => $statusOptions
        ]);
    }

    public function storeKanban(Request $request, Event $event) {
        $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:255'],
            'detail' => ['required', 'string', 'min:4', 'max:255'],
            'date_deadline' => ['required', 'date', 'after:today']
        ]);

        $kanban = new Kanban();
        $kanban->title = $request->get('title');
        $kanban->detail = $request->get('detail');
        $kanban->date_deadline = $request->get('date_deadline');
        $kanban->status = KanbanAccessibility::NOT_START->value;
        $event->kanbans()->save($kanban);
        return redirect()->route('events.kanbans.show', ['event'=> $event]);
    }

    public function destroyKanban(Event $event, Kanban $kanban) {
        $kanban->delete();
        return redirect()->route('events.kanbans.show', ['event'=> $event]);
    }

    public function updateStatusKanban(Request $request, Event $event, Kanban $kanban) {
        $request->validate([
            'status' => ['required', 'in:Not Start,In Progress,Success']
        ]);
        $kanban = $event->findByKanbanID($kanban->id);
        $kanban->status = $request->get('status');
        $kanban->save();
        return redirect()->route('events.kanbans.show', ['event'=> $event]);
    }

    public function show(Kanban $kanban)
    {
        return view('events.manage.kanban_show', ['kanban' => $kanban]);
    }
}
