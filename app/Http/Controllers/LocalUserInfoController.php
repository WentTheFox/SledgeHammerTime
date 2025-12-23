<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalUserInfoController extends Controller {
  public function forProvider(string $provider, string $id, Request $request) {
    $currentUser = Auth::user();
    if ($currentUser === null){
      return response()->noContent(401);
    }

    $staleAt = $request->get('stale_at');
    if ($staleAt === null) {
      return response()->noContent(400);
    }

    switch ($provider){
      case 'discord':
        $result = $currentUser->discordUsers()->whereDate('updated_at', '>=', $staleAt)->findOrFail($id);

        if ($result) {
          return response()->json($result->mapToUiInfo());
        }
      break;
      case 'crowdin':
        $result = $currentUser->crowdinUsers()->whereDate('updated_at', '>=', $staleAt)->findOrFail($id);

        if ($result) {
          return response()->json($result->mapToUiInfo());
        }
      break;
    }

    return response()->noContent(404);
  }
}
