<?php

namespace App\Enums;

enum ReviewDecision: string {
  case APPROVE = 'approve';
  case REJECT = 'reject';
}
