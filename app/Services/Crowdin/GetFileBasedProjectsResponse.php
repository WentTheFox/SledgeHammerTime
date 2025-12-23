<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Services\CreateFromResponseInterface;
use Illuminate\Http\Client\Response;

/**
 * @see https://support.crowdin.com/developer/api/v2/#tag/Projects/operation/api.projects.getMany
 */
final readonly class GetFileBasedProjectsResponse implements CreateFromResponseInterface {

  /**
   * @param array<FileBasedProject> $data
   */
  public function __construct(public array $data) {
  }

  public static function fromResponse(Response $response):self {
    $items = [];
    foreach ($response->json('data') as $item) {
      if (is_array($item) && array_key_exists('data', $item)) {
        $items[] = new FileBasedProject($item['data']['id'], $item['data']['identifier']);
      }
    }
    return new self($items);
  }
}
