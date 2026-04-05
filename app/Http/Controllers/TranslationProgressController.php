<?php

namespace App\Http\Controllers;

use App\Services\Crowdin\CrowdinCreditsService;
use Illuminate\Http\JsonResponse;

class TranslationProgressController extends Controller {
  function progress(string $locale):JsonResponse {
    return response()->json(app(CrowdinCreditsService::class)->getLocaleData($locale));
  }
}
