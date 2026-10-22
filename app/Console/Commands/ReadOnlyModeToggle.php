<?php

namespace App\Console\Commands;

use App\Support\ReadOnlyMode;
use Illuminate\Console\Command;

class ReadOnlyModeToggle extends Command {
  protected $signature = 'app:readonly {state : "on", "off" or "status"}';

  protected $description = 'Toggle read-only mode (reads served, writes rejected with 503), used during the deploy window';

  public function handle():int {
    switch ($this->argument('state')){
      case 'on':
        ReadOnlyMode::enable();
        break;
      case 'off':
        ReadOnlyMode::disable();
        break;
      case 'status':
        break;
      default:
        $this->error('State must be "on", "off" or "status"');

        return self::INVALID;
    }
    $this->info('Read-only mode is '.(ReadOnlyMode::isActive() ? 'ON' : 'OFF'));

    return self::SUCCESS;
  }
}
