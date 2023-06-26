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
<body 
class="antialiased text-gray-700 bg-gray-100"
>

@include('../components.organisms.header')

<main 
    id='app'
    class="flex flex-no-wrap h-[calc(100vh-80px)]
    @if(Request::url() !== "http://127.0.0.1:8000/profile")
        justify-center py-10
    @endif
    "
    >
        @yield('content')
</main>

@include('../partials.scripts')
@stack('scripts')
</body>
</html>