@extends('components.layouts.master')

@section('content')
<div class="px-4 mx-auto mt-12 lg:max-w-5xl">
    <div class="card">
        {{$question["question"]}}
    </div>

    <div class="grid gap-2 mt-6 grid-rows4 lg:grid-cols-2">
        <div class="card card-clickable">{{$question['answer']}}</div>
        {{-- <div class="card card-clickable">{{$question['choice2']}}</div>
        <div class="card card-clickable">{{$question['choice3']}}</div>
        <div class="card card-clickable">{{$question['choice4']}}</div> --}}
    </div>
</div>
@endsection

