<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.parts.head')
</head>
<body class="font-sans antialiased">
<main class="py-8 lg:py-12">
    <div class="container-full">
        <div class="max-w-xl mx-auto px-5">
            {{ $slot }}
        </div>
    </div>
</main>
@livewire('notifications')
@include('layouts.parts.foot')
</body>
</html>
