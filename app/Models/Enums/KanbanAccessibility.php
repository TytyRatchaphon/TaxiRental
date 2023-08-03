<?php

namespace App\Models\Enums;

enum KanbanAccessibility : string {
    case NOT_START = "Not Start";
    case IN_PROGRESS = "In Progress";
    case SUCCESS = "Success";

    public static function randomValue() : String {
        $i = fake()->randomNumber()%3;
        return self::cases()[$i]->value;
    }
}
