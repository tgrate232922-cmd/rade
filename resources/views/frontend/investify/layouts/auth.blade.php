<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(setting('site_favicon','global')) }}" type="image/x-icon"/>
    
    <!-- Modern Login CSS with correct path -->
    <link rel="stylesheet" href="{{ asset('global/css/modern-login.css') }}?v={{ time() }}">
    
    <title>{{ setting('site_title', 'global') }} - @yield('title')</title>
    
    <style>
        /* Force reset all default and theme styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: none !important;
            overflow-x: hidden;
        }
        
        /* Remove Bootstrap/theme container constraints */
        .container,
        .container-fluid,
        .row,
        .col,
        .col-xl-12,
        [class*="col-"] {
            all: unset !important;
            display: block !important;
        }
        
        /* Hide old theme elements */
        .rock-auth-section,
        .rock-auth-wrapper,
        .rock-auth-main,
        .rock-auth-from,
        .rock-auth-bg,
        .rock-auth-logo,
        .rock-auth-content,
        .rock-single-input,
        .rock-auth-btn {
            display: none !important;
        }
    </style>
</head>

<body>

@yield('content')

@yield('script')

</body>
</html>