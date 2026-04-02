<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

@hasSection('description')
    <meta name="description" content="@yield('description')">
@endif
@hasSection('image')
    <meta property="og:image" content="@yield('image')">
@endif
@hasSection('canonical')
    <link rel="canonical" href="@yield('canonical')">
@endif
@hasSection('robots')
    <meta name="robots" content="@yield('robots')">
@endif
@stack('meta')

<script>
    function onReady(callback) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            callback();
        } else {
            document.addEventListener("DOMContentLoaded", callback);
        }
    }
</script>
@vite([
    'resources/css/app.css',
    'resources/sass/main.sass',
    'resources/js/app.js',
])
@livewireStyles
@livewireScripts
<style>
    [x-cloak] {
        display: none !important;
    }
    /*
    [x-show] {
        transition-property: none !important;
    }*/
</style>
@stack('scripts')
@stack('styles')
{!! CookieConsent::styles() !!}
