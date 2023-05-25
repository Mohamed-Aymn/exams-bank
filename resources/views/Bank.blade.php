@extends('components.layouts.master')

@section('content')
<div class="px-8 mt-12">
    <h1 class="heading heading-1">Bank <span class="text-2xl font-thin">/Subjects</span></h1>
    {{-- TODO: each card should have bg color of the subject --}}
    <div class="flex gap-5 mt-6">
        <div class="w-64 card card-clickable">
            <h3 class="heading heading-3">Subject Name</h3>
            <div class="mt-4 line-clamp-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio sunt quod ullam hic architecto! Animi deserunt assumenda voluptas voluptatibus corporis maxime doloremque illo deleniti fugit, veniam est provident molestias distinctio!</div>
        </div>
        <div class="w-64 card card-clickable">
            <h3 class="heading heading-3">Subject Name</h3>
            <div class="mt-4 line-clamp-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio sunt quod ullam hic architecto! Animi deserunt assumenda voluptas voluptatibus corporis maxime doloremque illo deleniti fugit, veniam est provident molestias distinctio!</div>
        </div>
    </div>
</div>
@endsection