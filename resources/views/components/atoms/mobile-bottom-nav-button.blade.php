@php
    $i = 0;
@endphp

<div class="flex flex-wrap">
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
</div>