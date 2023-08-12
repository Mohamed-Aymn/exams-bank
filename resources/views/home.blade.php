@extends('components.layouts.master')

@section('content')

    @include("components.organisms.hero")

    <div class="centralization-container">
        @include("components.organisms.features")
        {{-- @include("components.organisms.faqs") --}}
        @include("components.organisms.contactus")
        {{-- TODO: create join us button --}}
    </div>
@endsection