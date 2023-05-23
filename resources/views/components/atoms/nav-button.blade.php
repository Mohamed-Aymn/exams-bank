<a 
    {{ $attributes->except('class') }}
    class="text-base font-medium text-black transition-all duration-200 cursor-pointer hover:text-primary-color text:bg-primary-color"
    > 
    {{ucfirst($slot)}}
</a>
