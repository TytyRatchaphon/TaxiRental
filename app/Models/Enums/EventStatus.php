<?php

namespace App\Models\Enums;

enum EventStatus : string {
    case PENDING = "pending";
    case APPROVED = "approved";
    case UNAPPROVED = "unapproved";
    case OVER = "over";
}
