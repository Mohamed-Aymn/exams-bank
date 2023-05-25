@extends('components.layouts.account')

@php
$content = [
    ["Stat 1", "#"], 
    ["Stat 2", "#"]
];
@endphp

@section('sidebar')
    <x-sidebar title="Content" :content="$content" />
@endsection

@section('content')
    <div>
    </div>
@endsection
@section('mobile-bottom-nav')
    <x-mobile-bottom-nav :content="$content"/>
@endsection