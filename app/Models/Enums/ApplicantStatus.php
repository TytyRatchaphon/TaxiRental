<?php

namespace App\Models\Enums;

enum ApplicantStatus : string {
    case PENDING = "pending";
    case APPROVED = "approved";
    case UNAPPROVED = "unapproved";
}
