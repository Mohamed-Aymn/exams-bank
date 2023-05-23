<div class="
overflow-hidden bg-white border border-gray-200 rounded-xl p-5
@if($isClickable)
    transition-all duration-200 cursor-pointer hover:bg-gray-50
@endif
{{$attributes->get('class')}}
"
{{ $attributes->except('class') }}
>
    {{$slot}}
</div>