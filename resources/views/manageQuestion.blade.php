@extends('components.layouts.master')


@section('content')
    <div class="card">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto unde quasi maiores repellendus nobis omnis soluta ex aliquam, laboriosam corrupti amet corporis. Iusto ullam temporibus, rem aperiam tempore qui ipsum.
    </div>
    <div class="grid gap-2 mt-6 grid-rows4 lg:grid-cols-2">
        <div class="card">asfd</div>
        <div class="card">asfd</div>
        <div class="card">asfd</div>
        <div class="card">asfd</div>
    </div>
    <div class="flex justify-between mt-6">
        <div>
            <span>Created by</span>
            <span>photo</span>
            <span>Name</span>
        </div>
        <form method="POST" action="/api/v1/question-requests">
            @csrf
            <button type="submit" name="is_accepted" value="1" class="btn btn-primary">Accept</button>
            <button type="submit" name="is_accepted" value="0" class="btn btn-secondary">Reject</button>
            <input hidden name="question_request_id" value="1659817560" />
        </form>
    </div>
@endsection