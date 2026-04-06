<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SentryWarningController extends Controller
{
    public function acknowledge(Request $request)
    {
        Session::put('sentry_warning_acknowledged', true);

        return redirect()->intended('/');
    }
}
