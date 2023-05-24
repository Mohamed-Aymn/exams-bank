<div class="absolute bottom-0 flex justify-center w-full gap-2 py-2 border-t border-gray-200 items-top bg-gray-50 sm:hidden">
    @php
        $i = 0;
    @endphp
    @while(isset($content[$i]))
        <x-mobile-bottom-nav-button content="{{$content[$i][0]}}" href="{{$content[$i][1]}}" />
        @php
            $i++;
        @endphp
    @endwhile
</div>