@extends('components.layouts.account')

@php
$content = [
    ["Question Requests", "#/question"], 
    ["Teacher Requests", "#/teachers"]
];
@endphp

@section('sidebar')
    <x-sidebar title="Content" :content="$content" />
@endsection


@section('content')
{{-- here is how side-cient side routing buttons will be made --}}
<a href="#/questions">dasf</a>

<div id="admin_manage">
</div>
@endsection

@section('mobile-bottom-nav')
    <x-mobile-bottom-nav :content="$content"/>
@endsection
