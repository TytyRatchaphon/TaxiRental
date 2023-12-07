<?php

namespace App\Models\Enums;

enum EventStatus : string {
    case PENDING = "pending";
    case APPROVED = "available";
    case UNAPPROVED = "occupied";
}
