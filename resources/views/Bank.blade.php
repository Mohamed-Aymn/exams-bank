@extends('components.layouts.master')

@section('content')
<div class="px-8 mt-12">
    <x-heading level="1">Bank <span class="text-2xl font-thin">/Subjects</span></x-heading>
    {{-- TODO: each card should have bg color of the subject --}}
    <div class="flex gap-5 mt-6">
        <x-card class="w-64" :isClickable="true">
            <x-heading level="3">Subject Name</x-heading>
            <div class="mt-4 line-clamp-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio sunt quod ullam hic architecto! Animi deserunt assumenda voluptas voluptatibus corporis maxime doloremque illo deleniti fugit, veniam est provident molestias distinctio!</div>
        </x-card>
        <x-card class="w-64" :isClickable="true">
            <x-heading level="3">Subject Name</x-heading>
            <div class="mt-4 line-clamp-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio sunt quod ullam hic architecto! Animi deserunt assumenda voluptas voluptatibus corporis maxime doloremque illo deleniti fugit, veniam est provident molestias distinctio!</div>
        </x-card>
    </div>
</div>
@endsection