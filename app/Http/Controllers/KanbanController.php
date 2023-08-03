<?php

namespace App\Http\Controllers;

use App\Models\Kanban;

class KanbanController extends Controller
{
    public function show() {
        $kanban = Kanban::get();
        return view('events.manage.kanban', [
            'kanbans' => $kanban
        ]);
    }
    public function create() {

    }
}
