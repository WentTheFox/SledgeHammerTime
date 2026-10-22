<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

/**
 * Only the bot (the console user) may ask for a login link
 */
class CreateBotLoginLinkRequest extends BotLoginRequest {
  public function authorize():bool {
    return Auth::user()?->id === config('app.console_user_uuid') && parent::authorize();
  }
}
