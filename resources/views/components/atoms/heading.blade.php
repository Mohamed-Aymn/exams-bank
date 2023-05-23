<h{{$level}} 
    class="font-bold leading-tight text-gray-900
        @if($level == 1)
            text-3xl md:text-5xl
        @elseif($level == 2)
            text-2xl md:text-4xl
        @elseif($level == 3)
            text-xl md:text-3xl
        @elseif($level == 4)
            text-lg md:text-xl
        @elseif($level == 5)
            text-base md:text-lg
        @elseif($level == 6)
            text-sm md:text-base
        @endif
        {{$attributes->get('class')}}
    "
    {{ $attributes->except('class') }}
    >
    {{$slot}}
</h{{$level}}>