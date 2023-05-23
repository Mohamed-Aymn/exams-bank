@if (!$isAnchor)
<button
class="
    cursor-pointer
    transition-all duration-200 
    {{$attributes->get('class')}}
    @if ($format == "primary")
        px-6 py-2 font-medium text-white bg-primary-color border border-transparent rounded-md focus:outline-none hover:bg-dark-primary-color focus:bg-blue-700
    @elseif ($format == "secondary")
        px-6 py-2 font-medium text-white transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-800 dark:focus:bg-gray-700
    @elseif ($format == "tertiary")
        text-sm text-gray-600 dark:text-gray-200 hover:underline
    @endif
"
{{ $attributes->except('class') }}
    >
    {{$slot}}
</button>
@else
    <a 
        class="
            cursor-pointer
            {{$attributes->get('class')}}
            text-sm text-gray-600 dark:text-gray-200 hover:underline"
        {{ $attributes->except('class') }}
        >
        {{$slot}}
    </a>
@endif






{{-- @if ($type == "primary")
        class="px-6 py-2 font-medium text-white border border-transparent rounded-md bg-primary-color focus:outline-none hover:bg-dark-primary-color focus:bg-blue-700"
    @elseif ($type == "secondary")
        class="px-6 py-2 font-medium text-white transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-800 dark:focus:bg-gray-700"
    @elseif ($type == "tertiary")
        class="text-sm text-gray-600 dark:text-gray-200 hover:underline"
    @endif --}}