<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>Exams Bank</title>

    @include('../partials.styles')
</head>
<body class="antialiased text-gray-700 bg-gray-100">

@if ($showHeader)
    @include('../components.organisms.header')
@endif

<main>
    @yield('content')
</main>

@if ($showFooter)
    @include('../components.organisms.footer')
@endif

@include('../partials.scripts')
<!-- custom JavaScript code -->
@stack('scripts')

</body>
</html>