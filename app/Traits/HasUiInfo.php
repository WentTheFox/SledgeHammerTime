<?php

namespace App\Traits;

trait HasUiInfo {
  /**
   * @return array<string, mixed>
   */
  abstract function mapToUiInfo():array;
}
