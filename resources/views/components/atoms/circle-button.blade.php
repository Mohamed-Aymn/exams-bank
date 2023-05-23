<button 
    class="{{$isFloating ? "absolute" : NULL}} flex items-center justify-center p-4 font-bold text-black bg-white rounded-full hover:bg-neutral-2 {{$isFloating && $floatPlace ? $floatPlace : NULL}} {{$animation}} {{$icon}}"
    id="{{$id ? $id : NULL}}"
    />