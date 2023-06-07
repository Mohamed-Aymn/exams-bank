@extends('components.layouts.master')

@section('content')

<input class="input" placeholder="load form saved preffrences" />
<div class="flex items-center justify-between">
    <div>
        <h2 class="heading heading-3">Subject</h2>
        <h1 class="heading heading-1">Subject Name</h1>
    </div>

    <div>
        <h2 class="heading heading-3">Time</h2>
        <h1 class="heading heading-1">12:00</h1>
    </div>
</div>

<form action="/api/exams" method="POST">
    @csrf
    <input class="input" placeholder="time" name="duration" />
    <input class="input" placeholder="Number of mcq questions" type="number" />
    <input class="input" placeholder="Number of true or false questions" type="number" />
    
    
    <div class="flex justify-end w-full gap-4 items-st flex-end">
        <button class="btn btn-tertiary">Cancel</button>
        <button class="w-36 btn btn-primary" type="submit">Start</button>
    <div>
            
</form>
@endsection