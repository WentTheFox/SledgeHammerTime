<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Models\CrowdinUser;
use Illuminate\Container\Attributes\Singleton;

#[Singleton]
class CrowdinUserService {
  public function __construct(protected CrowdinApiService $crowdinApiService) { }

  function refreshUserInfo(string $userId):CrowdinUser {
    $userInfo = $this->crowdinApiService->getProjectMember((int)$userId);

    return $this->updateUserInfo($userInfo);
  }

  protected function updateUserInfo(GetProjectMemberResponse $data):CrowdinUser {
    return CrowdinUser::updateOrCreate([
      'id' => $data->id,
    ], [
      'id' => $data->id,
      'username' => $data->username,
      'full_name' => $data->fullName,
      'avatar_url' => $data->avatarUrl,
      'updated_at' => now(),
    ]);
  }
}
