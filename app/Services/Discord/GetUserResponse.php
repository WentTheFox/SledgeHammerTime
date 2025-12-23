<?php

namespace App\Services\Discord;

use App\Services\CreateFromResponseInterface;
use Illuminate\Http\Client\Response;

/**
 * @see https://discord.com/developers/docs/resources/user#user-object-user-structure
 */
final readonly class GetUserResponse implements CreateFromResponseInterface {

  public function __construct(
    /**
     * the user's id
     */
    public string $id,
    /**
     * the user's username, not unique across the platform
     */
    public string $username,
    /**
     * the user's Discord-tag
     */
    public string $discriminator,
    /**
     * the user's display name, if it is set. For bots, this is the application name
     */
    public ?string $global_name,
    /**
     * the user's [avatar hash]
     * [avatar hash]: https://discord.com/developers/docs/reference#image-formatting
     */
    public ?string $avatar
  ) {
  }

  public static function fromResponse(Response $response):self {
    return new self(
      id: $response->json('id'),
      username: $response->json('username'),
      discriminator: $response->json('discriminator'),
      global_name: $response->json('global_name'),
      avatar: $response->json('avatar'),
    );
  }
}
