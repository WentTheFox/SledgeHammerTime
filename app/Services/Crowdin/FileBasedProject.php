<?php

namespace App\Services\Crowdin;

use App\Services\CreateFromResponseInterface;
use Illuminate\Http\Client\Response;

/**
 * @see https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.getMany
 */
final readonly class FileBasedProject {
  public function __construct(
    public int $id,
    public string $identifier,
  ) {
  }
}
