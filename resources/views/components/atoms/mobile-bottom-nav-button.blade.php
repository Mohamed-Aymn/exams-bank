@php
    $i = 0;
@endphp

<a 
    href="{{$attributes->get('href')}}"
    class="flex flex-wrap cursor-pointer"
    >
    @while(true)
        @if(isset($content[$i]))
            <div class="w-full text-center">{{$content[$i]}}</div>
            @php
                $i++;
            @endphp
        @else
            @php
                break;
            @endphp
        @endif
    @endwhile
</a>