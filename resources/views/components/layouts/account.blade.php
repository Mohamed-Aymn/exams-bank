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

<main class="flex flex-no-wraph h-[calc(100vh-80px)]">

    @yield('sidebar')
    {{-- <div class="absolute flex-col justify-between hidden w-64 shadow bg-gray-50 sm:relative md:h-full sm:flex">
        <div class="px-8 mt-12">
            <div class="text-gray-400">Content</div>

            <x-button :isAnchor="true" format="tertiary" class="ml-2">
                State 1
            </x-button>
        </div>
    </div> --}}

    {{-- content --}}
    <div class="container w-11/12 h-64 px-6 py-10 mx-auto md:w-4/5">
        @yield('content')
    </div>


    {{-- small screens bottom-nav --}}
    @yield('mobile-bottom-nav')
    {{-- <div class="absolute bottom-0 flex justify-center w-full gap-2 py-2 border-t border-gray-200 items-top bg-gray-50 sm:hidden">
        <x-mobile-bottom-nav-button content="Question Requests" />
        <x-mobile-bottom-nav-button content="Teacher Requests" />
        <x-mobile-bottom-nav-button content="Feedbacks" />
    </div> --}}
</main>

@include('../partials.scripts')
@stack('scripts')

</body>
</html>