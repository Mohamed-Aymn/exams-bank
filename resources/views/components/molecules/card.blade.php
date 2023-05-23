<div class="overflow-hidden bg-white border border-gray-200 rounded-xl p-5
{{$attributes->get('class')}}
@if($isClickable)
    transition-all duration-200 cursor-pointer hover:bg-gray-50
@endif
"
{{ $attributes->except('class') }}
>
    {{$slot}}
</div>