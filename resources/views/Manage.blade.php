@extends('components.layouts.account')

@php
$content = [
    ["Question Requests", "#/questions"], 
    ["Teacher Requests", "#/teachers"]
];
@endphp

@section('sidebar')
    <x-sidebar title="Content" :content="$content" />
@endsection

@section('content')
    {{-- TODO: if manage route is displayed without#question or #teacher, redirect the user to one of them --}}
    <div id="admin_manage">
    </div>
@endsection

@section('mobile-bottom-nav')
    <x-mobile-bottom-nav :content="$content"/>
@endsection
