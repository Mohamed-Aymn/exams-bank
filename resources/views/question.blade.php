@extends('components.layouts.master')

@section('content')
<div class="px-4 mx-auto mt-12 lg:max-w-5xl">
    <div class="card">
        {{$question["question"]}}
    </div>

    @if($question['type'] == 1)
        @php 
            $choices = array($question['answer'], $question['choice2'], $question['choice3'], $question['choice4']);
            shuffle($choices);
        @endphp
    @endif

    <div class="grid gap-2 mt-6 grid-rows4 lg:grid-cols-2">
        <div class="card card-clickable">{{$choices[0]}}</div>
        <div class="card card-clickable">{{$choices[1]}}</div>
        <div class="card card-clickable">{{$choices[2]}}</div>
        <div class="card card-clickable">{{$choices[3]}}</div>
    </div>
</div>
@endsection



