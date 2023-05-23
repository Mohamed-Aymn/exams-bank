@extends('components.layouts.master')


@section('content')
<div class="px-8 my-12">

    <x-heading level="1">Bank <span class="text-2xl font-thin">/SubjectName</span><span class="text-2xl font-thin">/Questions</span></x-heading>

    <x-card class="mt-6">
        <div class="overflow-hidden mt-7">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-white ">
                    <tr class="text-left">
                        <th ></th>
                        <th class="mr-4">Title</th>
                        <th class="pr-4">Author</th>
                        <th class="pr-4 text-left">Date</th>
                        <th>Question</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    @endphp

                    @while($i<100)
                    <tr 
                        tabindex="0" 
                        onclick="location.href='{{url('bank/questions/question')}}'"
                        class="h-16 border border-gray-100 rounded cursor-pointer focus:outline-none dark:border-gray-600"
                        >
                        <td>
                            <div class="mx-5">#</div>
                        </td>
                        <td class="pr-4">
                            <p class="font-medium">Marketing Keynote Presentation</p>
                        </td>
                        <td>
                            Author
                        </td>
                        <td>
                            Date
                        </td>
                        <td>
                            <p class="overflow-hidden whitespace-nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dolore labore obcaecati dolorem in! Exercitationem qui quasi ipsa, quo quaerat vero velit veniam rerum quam dolore repellat quod temporibus natus? </p>
                        </td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endwhile
                </tbody>
            </table>
        </div>
    </x-card>
</div>
<style>
    .checkbox:checked + .check-icon {
        display: flex;
    }
</style>

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