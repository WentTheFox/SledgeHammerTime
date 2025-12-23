<?php

namespace App\Services\Crowdin;

use Illuminate\Container\Attributes\Singleton;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

#[Singleton]
class CrowdinApiService {
  protected ?int $projectId = null;
  protected readonly string $projectIdentifier;

  public function __construct() {
    $this->projectId = config('services.crowdin.project_id');
    $this->projectIdentifier = config('services.crowdin.project_identifier');
  }

  protected function createPendingRequest():PendingRequest {
    return Http::asJson()
      ->baseUrl(config('services.crowdin.base_url'))
      ->withHeaders([
        'Authorization' => sprintf('Bearer %s', config('services.crowdin.api_key')),
        'Accept' => 'application/json',
      ]);
  }

  protected function getProjectId():string {
    if ($this->projectId === null){
      $projects = $this->getFileBasedProjects();
      foreach ($projects->data as $project){
        if ($project->identifier === $this->projectIdentifier){
          $this->projectId = $project->id;
        }
      }
    }

    if ($this->projectId === null) {
      throw new RuntimeException(sprintf('Could not determine Crowdin project ID from identifier %s', $this->projectIdentifier));
    }

    return $this->projectId;
  }

  public function getFileBasedProjects():GetFileBasedProjectsResponse {
    $response = $this->createPendingRequest()->get('/projects?type=0');

    return GetFileBasedProjectsResponse::fromResponse($response);
  }

  public function getProjectMember(int $id):GetProjectMemberResponse {
    $response = $this->createPendingRequest()->get(sprintf('/projects/%s/members/%s', $this->getProjectId(), $id));
    return GetProjectMemberResponse::fromResponse($response);
  }
}
