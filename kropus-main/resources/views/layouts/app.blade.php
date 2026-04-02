<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.parts.head')
</head>
<body class="font-sans antialiased">
@livewire('private-mode')
@livewire('layout.header')
<main>
    {{ $slot }}
</main>
@livewire('layout.footer')
@livewire('notifications')
@livewire('wire-elements-modal')
@include('layouts.parts.foot')
</body>
</html>
