<div class="accordion flex flex-col gap-2
{{$attributes->get('class')}}
"
{{ $attributes->except('class') }}
>
    @foreach($children as $child)
        <div class="card accordion-item" :isClickable="true">
            <div class="flex items-center justify-between cursor-pointer accordion-title">
                @if(substr($titleTag, 0, 1) == "h")
                    <h1 :level="substr($titleTag, 1, 1)">
                        {{ucfirst($child[0])}}
                    </h1>
                @else
                    <{{$titleTag}} class="mr-2">
                        {{$child[0]}}
                    </{{$titleTag}}>
                @endif
                <i class="transition-all accordion-icon fas fa-chevron-down"></i>
            </div>
            <div class="hidden py-2 accordion-content">
                {{$child[1]}}
            </div>
        </div>
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