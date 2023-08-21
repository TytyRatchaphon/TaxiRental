<?php

namespace App\Http\Controllers;

use App\Models\Enums\KanbanStatus;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class KanbanController extends Controller
{
    public function showKanbans(Event $event) {
        Gate::authorize('viewKanban', $event);
        $statusOptions = KanbanStatus::cases();
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
        $kanban->status = KanbanStatus::NOT_START->value;
        $event->kanbans()->save($kanban);
        return redirect()->route('events.kanbans.show', ['event'=> $event]);
    }

    public function destroyKanban(Event $event, Kanban $kanban) {
        $kanban->delete();
        return redirect()->route('events.kanbans.show', ['event'=> $event]);
    }

    public function updateStatusKanban(Request $request, Event $event, Kanban $kanban) {
        $request->validate([
            'status' => ['required']
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
