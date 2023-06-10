<label class="relative inline-flex items-center cursor-pointer">
    @if($secondOption != null)
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$secondOption}}</span>
    @endif
    <input type="checkbox" id="{{$id}}" value="" class="sr-only peer" 
    @if($default == "firstOption")
        checked
    @endif
    >
    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 ml-3 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$firstOption}}</span>
</label>
