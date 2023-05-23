@extends('components.layouts.master')

@section('content')
<div class="flex flex-no-wraph h-[calc(100vh-80px)]">

    {{-- sidebar --}}
    <div class="absolute flex-col justify-between hidden w-64 shadow bg-gray-50 sm:relative md:h-full sm:flex">
        {{-- side-bar links --}}
        <div class="px-8 mt-12">
            <div class="text-gray-400">
                Content
            </div>
            {{-- TODO: create component link component and pass an array to it to loop on it's elements --}}
            <x-button :isAnchor="true" format="tertiary" class="ml-2">
                State 1
            </x-button>
        </div>
    </div>

    {{-- content --}}
    <div class="container w-11/12 h-64 px-6 py-10 mx-auto md:w-4/5">
    </div>


    {{-- small screens bottom-nav --}}
    <div class="absolute bottom-0 flex justify-center w-full gap-2 py-2 border-t border-gray-200 items-top bg-gray-50 sm:hidden">
        <x-mobile-bottom-nav-button content="Question Requests" />
        <x-mobile-bottom-nav-button content="Teacher Requests" />
        <x-mobile-bottom-nav-button content="Feedbacks" />
    </div>
</div>
@endsection