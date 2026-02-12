<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;700&display=swap" rel="stylesheet">
    <title>{{ $details['title'] }}</title>
    <style>
        @media (max-width: 650px) {.container{width:550px}}
        @media (max-width: 500px) {.container{width:400px}}
        @media (max-width: 380px) {.container{width:340px}}
        @media (max-width: 320px) {.container{width:290px}}
        a { text-decoration:none }
    </style>
</head>
<body style="margin:0;padding:0;font-family:'Jost',sans-serif;background:#16273a;">
@php
  /* Brand colors you can override from the controller */
  $brand      = $details['brand']      ?? '#196ED2';  // header + content background
  $brandText  = $details['brand_text'] ?? '#FFFFFF';  // text on brand background
@endphp

<div class="container" style="width:650px;margin:0 auto;padding:15px 0;">

    <!-- Header with brand background behind the logo -->
    <div class="header" style="padding:18px 16px;background:{{ $brand }};">
        <a href="{{ $details['site_link'] }}" style="display:inline-block;">
            <img src="{{ asset(setting('site_logo','global')) }}"
                 alt="{{ $details['site_title'] ?? 'Logo' }}"
                 style="height:40px;width:auto;display:block;"/>
        </a>
    </div>

    <div class="main-content">
        @if(!empty($details['banner']))
      
        @endif

        <!-- Content card uses SAME brand background as header -->
        <div class="contents" style="background:{{ $brand }};color:{{ $brandText }};padding:35px;">
            <h2 style="margin:0 0 20px;font-size:24px;font-weight:700;color:{{ $brandText }};">
                {{ $details['title'] }}
            </h2>

            @if(!empty($details['salutation']))
            <div style="margin:8px 0 14px;color:{{ $brandText }};opacity:.95;">
                {{ $details['salutation'] }}
            </div>
            @endif

            <div style="margin:0 0 24px;line-height:28px;font-size:16px;color:{{ $brandText }}">
                {!! $details['message_body'] !!}
            </div>

            @if(!empty($details['button_link']) && !empty($details['button_level']))
            <!-- Inverted button so it pops on brand bg -->
            <a href="{{ $details['button_link'] }}"
               style="display:inline-block;margin-top:6px;padding:14px 28px;border-radius:6px;
                      background:#ffffff;color:{{ $brand }};font-weight:700;text-transform:uppercase;
                      font-size:13px;border:1px solid #ffffff;">
                {{ $details['button_level'] }}
            </a>
            @endif

            @if(!empty($details['footer_status']))
            <div style="margin-top:28px;border-top:1px solid rgba(255,255,255,0.25);padding-top:14px;">
                <img src="{{ asset(setting('site_logo','global')) }}"
                     alt="{{ $details['site_title'] ?? 'Logo' }}"
                     style="height:16px;margin-bottom:8px;display:block;opacity:.95;">
                <p style="margin:0;font-size:14px;line-height:20px;color:{{ $brandText }};opacity:.95;">
                    {!! $details['footer_body'] !!}
                </p>
            </div>
            @endif
        </div>

        @if(!empty($details['bottom_status']))
        <!-- Optional white section below -->
        <div style="padding:35px;background:#ffffff;margin-top:15px;">
            <h3 style="margin:0 0 10px;font-size:18px;font-weight:700;color:#0f172a;">
                {{ $details['bottom_title'] }}
            </h3>
            <p style="margin:0;font-size:14px;line-height:24px;color:#334155;">
                {!! $details['bottom_body'] !!}
            </p>
            <a href="{{ $details['site_link'] }}" style="display:inline-block;margin-top:10px;
               font-size:14px;font-weight:600;color:{{ $brand }};">Learn More</a>
        </div>
        @endif
    </div>
</div>
</body>
</html>
