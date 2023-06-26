@extends('components.layouts.account')

@section('content')

{{-- TODO: this should be dropdown --}}
<input class="input" placeholder="load form saved preffrences" />
<div class="flex items-center justify-around my-6">
    <div class="card">
        <h2 class="heading heading-3">Subject</h2>
        <h1 class="heading heading-1">Subject Name</h1>
    </div>

    <div class="card">
        <h2 class="heading heading-3">Time</h2>
        <h1 class="heading heading-1">12:00</h1>
    </div>
</div>

<form action="/exams" method="POST">
    @csrf

    <input class="input" placeholder="subject" name="subject"/>
    <input class="input" placeholder="time" name="duration" />
    
    {{--  sets of questions --}}
    <div class="flex">
        {{-- TODO: all of those should be drop down --}}
        <input class="input" placeholder="type" name="type[]" />
        <input class="input" placeholder="nubmer" name='number[]' type="number" />
        <input class="input" placeholder="level" name='level[]' />
        {{-- TODO: add set button --}}
    </div>
    
    <div class="flex justify-end w-full gap-4 items-st flex-end">
        <button class="btn btn-tertiary">Cancel</button>
        <button class="w-36 btn btn-primary" type="submit">Start</button>
    <div>
</form>
@endsection