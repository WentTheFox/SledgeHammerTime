<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Services\CreateFromResponseInterface;
use Illuminate\Http\Client\Response;

/**
 * @see https://support.crowdin.com/developer/api/v2/#tag/Users/operation/api.projects.members.get
 */
final readonly class GetProjectMemberResponse implements CreateFromResponseInterface {

  public function __construct(
    public int $id,
    public string $username,
    public ?string $fullName,
    public ?string $avatarUrl
  ) {
  }

  public static function fromResponse(Response $response):self {
    return new self(
      id: $response->json('data.id'),
      username: $response->json('data.username'),
      fullName: $response->json('data.fullName'),
      avatarUrl: $response->json('data.avatarUrl'),
    );
  }
}
