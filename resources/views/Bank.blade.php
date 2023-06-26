@extends('components.layouts.account')

@section('content')
    <div class="w-full px-10 max-w-7xl">
        <h1 class="heading heading-1">Bank</h1>
        {{-- TODO: each card should have bg color of the subject --}}
        <div class="flex gap-5 mt-6">
            @forEach($subjects as $subject)
                <a href="/bank/{{$subject["name"]}}">
                    <div class="w-64 card card-clickable">
                        <h3 class="heading heading-3">{{$subject["name"]}}</h3>
                        <div class="mt-4 line-clamp-5">{{$subject["description"]}}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    @endsection