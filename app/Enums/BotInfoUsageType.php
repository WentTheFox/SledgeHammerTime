<?php

namespace App\Enums;

enum BotInfoUsageType: string {
  case COMMAND = 'command';
  case OPTION = 'option';
}
