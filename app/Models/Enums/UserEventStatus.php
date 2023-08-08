<?php

namespace App\Models\Enums;

enum UserEventStatus : string {
    case WAITING_APPROVAL = "wait_approval";
    case PARTICIPANT = "participant";
    case STAFF = "staff";
    case HEAD_STAFF = "head_staff";
}
