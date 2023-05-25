@extends('components.layouts.master')


@section('content')
<div class="px-8 my-12">

    <h1 class="heading heading-1">Users</h1>

    <div class="mt-6 overflow-hidden card">
        <table class="table">
            <thead>
                <tr class="tr">
                    <th class="th" ></th>
                    <th class="th">Name</th>
                    <th class="th">Date</th>
                    <th class="th">Description</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @while($i<100)
                    <tr 
                    tabindex="0" 
                    v-on:click="changeRoute('manage/teachers/teacher')"
                    class="tr-button"
                    >
                        <td class="td">
                            <span>#</span>
                        </td>
                        <td class="td" >
                            <p class="font-medium">Sanjeet Nthanda</p>
                        </td>
                        <td class="td">
                            Date
                        </td>
                        <td class="td">
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