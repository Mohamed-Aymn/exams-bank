@extends('components.layouts.master')

@php
    $optionQueryParam = ucfirst(request()->input('option', 'default_value'));
@endphp

@section('content')

    <div>
        <h1 class="heading heading-1">
            Create
            {{$optionQueryParam}}
        </h1>

        @if($optionQueryParam == "Question")
            <x-drop-down
                id="drafts" 
                :options="['first', 'second', 'third']"
                />

            <div>OR</div>
                
            <form action="/api/v1/questions" method="POST">
                @csrf
                <div class="flex flex-col gap-2 my-4">
                    <input class="input" placeholder="Subject" type="text" name="subject" />
                    <input class="input" placeholder="Question" type="text" name="question" />
                    <input class="input" placeholder="type" type="text" id="question-type-field" name="type"/>
                    <x-drop-down
                        id="questionType" 
                        :options="['MCQ', 'True or false']"
                        />
                    <input class="input" placeholder="level" type="text" name="level"  />
                    <input class="input" placeholder="Answer" type="text" name="answer" />
                    <input class="input" placeholder="Wrong choice 2" type="text" name="choice2" />
                    <input class="input" placeholder="Wrong choice 3" type="text" name="choice3" />
                    <input class="input" placeholder="Wrong choice 4" type="text" name="choice4" />
                    <input class="input" placeholder="about" type="text" name="about" />
                </div>

                <div class="flex items-center justify-between">
                    <button class="btn btn-tertiary">Cancel</button>
                    <div>
                        <button class="btn btn-secondary">Save in drafts</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            <form>
        @else
        {{-- create new subject form --}}
        <form action="/api/v1/subjects" method="POST">
            @csrf
            <div class="flex flex-col gap-2 my-4">
                <input class="input" placeholder="name" type="text" name="name" />
                <input class="input" placeholder="description" type="text" name="description"/>
                <input class="input" placeholder="color" type="text" name="color" />
            </div>

            <div class="flex items-center justify-between">
                <button class="btn btn-tertiary">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    
</script>
@endpush