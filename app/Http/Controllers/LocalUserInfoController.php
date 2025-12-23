<?php

namespace App\Http\Controllers;

use App\Models\CrowdinUser;
use App\Models\DiscordUser;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalUserInfoController extends Controller {
  public function forProvider(string $provider, string $id, Request $request) {
    $currentUser = Auth::user();
    if ($currentUser === null){
      return response()->json(['error' => 'You must be logged in to use this endpoint'], 401);
    }

    $staleAt = $request->get('stale_at');
    if ($staleAt === null){
      return response()->json(['error' => 'stale_at query parameter is required'], 422);
    }
    try {
      $staleAtDate = Carbon::parse($staleAt);
    }
    catch (InvalidFormatException $_){
      return response()->json(['error' => 'stale_at query parameter must be set to a valid date'], 422);
    }

    $result = null;
    switch ($provider){
      case 'discord':
        $result = DiscordUser::whereDate('updated_at', '>=', $staleAtDate)->find($id);
      break;
      case 'crowdin':
        $result = CrowdinUser::whereDate('updated_at', '>=', $staleAtDate)->find($id);
      break;
      default:
        return response()->json(['error' => sprintf("Unsupported provider %s", $provider)], 404);
    }

    if (!$result){
      return response()->json(['error' => 'Requested user is not found in local database'], 404);
    }

    if ($result->user_id !== $currentUser->id){
      return response()->json(['error' => 'Requested user is not linked to your account'], 403);
    }

    return response()->json($result->mapToUiInfo());
  }
}
