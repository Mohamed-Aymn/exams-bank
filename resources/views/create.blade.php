@extends('components.layouts.master')

@section('content')

    <input class="input" placeholder="Load from drafts" />
    OR
    <input class="input" placeholder="Subject" />
    <input class="input" placeholder="Name" />
    <input class="input" placeholder="Question type" />
    <input class="input" placeholder="Question" />
    <input class="input" placeholder="Choices" />

    <button class="btn btn-secondary">Cancel</button>
    <button class="btn btn-secondary">Drafts</button>
    <button class="btn btn-primary">Submit</button>

@endsection