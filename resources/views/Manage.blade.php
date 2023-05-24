@extends('components.layouts.account')


@section('sidebar')

<x-sidebar title="Content" :content="[["Section 1", "#/question"], ["Section 2", "#/teachers"]]"></x-sidebar>
@endsection


@section('content')

{{-- here is how side-cient side routing buttons will be made --}}
<a href="#/questions">dasf</a>

<div id="admin_manage">
</div>
@endsection

