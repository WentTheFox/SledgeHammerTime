<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="theme-color" content="#5865F2" />
  <meta name="color-scheme" content="light dark" />
  <meta name="keywords" content="discord,chat,formatting,timestamps,date,markdown" />

  <link rel="icon" href="/logos/logo.png" />
  @php
    $appName = config('app.name', 'Laravel');
  @endphp

  <title inertia>{{ $appName }}</title>

  <meta property="og:title" content="{{ $appName }}">
  <meta property="og:description" content="{{ __('global.seoDescription') }}">
  <meta property="og:image" content="{{ config('app.url') }}/logos/social.png">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ config('app.url') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="{{ App::getLocale() }}">
  <meta property="og:site_name" content="HammerTime">

  {{-- Fonts --}}
  @googlefonts
  {{-- FontAwesome styles are critical to avoid "large icon" FOUC, so inline them --}}
  <style>@php include base_path('node_modules/@fortawesome/fontawesome-free/css/svg-with-js.min.css') @endphp</style>

  {{-- Scripts --}}
  @routes
  @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
  @inertiaHead
</head>
<body class="no-anim">
@inertia
</body>
</html>
