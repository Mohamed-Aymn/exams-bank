@extends('components.layouts.master')

@section('content')
<div class="px-4 mx-auto mt-12 lg:max-w-5xl">
    <x-card>
        Content, Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius ut animi molestias voluptate consequatur! Nostrum possimus earum necessitatibus veritatis a neque sed doloremque perspiciatis id beatae reprehenderit, pariatur dignissimos voluptatibus.
    </x-card>

    <div class="grid gap-2 mt-6 grid-rows4 lg:grid-cols-2">
        <x-card :isClickable="true">asfd</x-card>
        <x-card :isClickable="true">asfd</x-card>
        <x-card :isClickable="true">asfd</x-card>
        <x-card :isClickable="true">asfd</x-card>
    </div>
</div>
@endsection

