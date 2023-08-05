<?php

namespace App\Http\Controllers;

use App\Models\Enums\KanbanAccessibility;
use App\Models\Event;
use App\Models\Kanban;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index() {
        $event = Event::find(2);
//        $kanbans = $event->kanbans()->get();
//        $kanban = Kanban::get();
        $statusOptions = KanbanAccessibility::cases();
        return view('events.manage.kanban', [
            'event' => $event,
//            'kanbans' => $kanbans,
            'statusOptions' => $statusOptions
        ]);
    }
    public function store(Request $request, Event $event) {
        $kanban = new Kanban();
        $kanban->title = $request->get('title');
        $kanban->detail = $request->get('detail');
        $kanban->date_deadline = $request->get('date_deadline');
        $kanban->status = 'Not Start';
        $kanban->event_id = 2; // $event->id events.kanbans.store
        $kanban->save();
        return redirect()->route('events.index');
    }
    public function destroy(Kanban $kanban) {
        $kanban->delete();
        return redirect()->route('events.index');
    }
    public function update(Request $request, Kanban $kanban) {
        $kanban->status = $request->get('status');
        $kanban->save();
        return redirect()->route('kanbans.index');
    }
}
