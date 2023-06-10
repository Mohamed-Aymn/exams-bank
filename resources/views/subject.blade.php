@extends('components.layouts.master')

@section('content')
<div class="px-8 my-12">

    {{-- navigator --}}
    <h1 class="heading heading-1">
        Bank 
        <a 
            href="/bank/{{$subject}}" 
            class="text-2xl font-thin"
            >
            /{{$subject}}
        </a>
        <span class="text-2xl font-thin">
            /Questions
        </span>
    </h1>

    {{-- table --}}
    <div class="mt-6 overflow-hidden card">
        <table class="table">
            <thead>
                <tr class="tr">
                    <th class="th">Type</th>
                    <th class="th">Title</th>
                    <th class="th">Author</th>
                    <th class="th">Date</th>
                    <th class="th">Question</th>
                </tr>
            </thead>
            <tbody>

                @foreach($questions as $question)
                    @php
                        $questionId = "asdf";
                    @endphp
                    <tr 
                        tabindex="0" 
                        {{-- onclick="location.href='{{url('bank/questions/question')}}'" --}}
                        onclick="location.href=`{{$subject}}/{{$question['question_id']}}`"
                        class="tr-button"
                        >
                        <td class="td">
                            <span>{{$question["type"]}}</span>
                        </td>
                        <td class="td" >
                            <p class="font-medium">{{$question["question"]}}</p>
                        </td>
                        <td class="td" >
                            {{$question["creator"]}}
                        </td>
                        <td class="td">
                            Date
                        </td>
                        <td class="td">
                            <p class="overflow-hidden whitespace-nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dolore labore obcaecati dolorem in! Exercitationem qui quasi ipsa, quo quaerat vero velit veniam rerum quam dolore repellat quod temporibus natus? </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@push('scripts')
{{-- <script>
    function dropdownFunction(element) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
        list.classList.add("target");
        for (i = 0; i < dropdowns.length; i++) {
            if (!dropdowns[i].classList.contains("target")) {
                dropdowns[i].classList.add("hidden");
            }
        }
        list.classList.toggle("hidden");
    }
</script> --}}
@endpush