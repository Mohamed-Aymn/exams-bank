<div class="accordion flex flex-col gap-2
{{$attributes->get('class')}}
"
{{ $attributes->except('class') }}
>
    @foreach($children as $child)
        <x-card :isClickable="true" class="accordion-item">
            <div class="accordion-title flex justify-between items-center cursor-pointer">
                @if(substr($titleTag, 0, 1) == "h")
                    <x-heading :level="substr($titleTag, 1, 1)">
                        {{ucfirst($child[0])}}
                    </x-heading>
                @else
                    <{{$titleTag}} class="mr-2">
                        {{$child[0]}}
                    </{{$titleTag}}>
                @endif
                <i class="accordion-icon fas fa-chevron-down transition-all"></i>
            </div>
            <div class="accordion-content py-2 hidden">
                {{$child[1]}}
            </div>
        </x-card>
    @endforeach
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $('.accordion-title').click(function() {
            // Close all other accordions
            $('.accordion-item').not($(this).parent()).removeClass('active');
            $('.accordion-content').not($(this).siblings('.accordion-content')).slideUp();
            $('.accordion-icon').not($(this).children('.accordion-icon')).removeClass('rotate-180');
            
            // Toggle current accordion
            $(this).parent().toggleClass('active');
            $(this).siblings('.accordion-content').slideToggle();
            $(this).children('.accordion-icon').toggleClass('rotate-180');
        });
    });
</script>
@endpush