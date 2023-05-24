{{-- sidebar body --}}
<div class="absolute flex-col justify-between hidden w-64 shadow bg-gray-50 sm:relative md:h-full sm:flex">
    {{-- side-bar links --}}
    <div class="px-8 mt-12">

        {{-- sidebar title --}}
        <div class="text-gray-400">{{$title}}</div>

        {{-- links --}}
        @php
            $i = 0;
        @endphp
        @while(isset($content[$i]))
            <x-button :isAnchor="true" href="{{$content[$i][1]}}" format="tertiary" class="block ml-2">
                {{$content[$i][0]}}
            </x-button>
            @php
                $i++;
            @endphp
        @endwhile
    </div>
</div>