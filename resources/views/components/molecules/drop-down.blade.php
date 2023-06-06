<div class="isolate {{$attributes->get('class')}}" id="{{$id}}" {{$id}}-option="">
	<button id="{{$id}}-button" data-dropdown-toggle="dropdown" class="z-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

	<div id="{{$id}}-drop-down" class="relative z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
		<ul 
			class="absolute top-0 w-full py-2 text-sm text-gray-700 card dark:text-gray-200" 
			aria-labelledby="dropdownDefaultButton"
			>
			@foreach($options as $option)
				<li 
					option-item
					class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
					>
					{{$option}}
				</li>
			@endforeach
		</ul>
	</div>
</div>

@push('scripts')
<script>
    let {{$id}} = `{{$id}}`;
	const {{$id}}dropdownContainer = document.getElementById('{{$id}}');
	const {{$id}}dropdownButton = document.getElementById(`{{$id}}-button`);
	const {{$id}}dropdownMenu = document.getElementById(`{{$id}}-drop-down`);
	const {{$id}}items = document.querySelectorAll("[option-item]");

	// Toggle the dropdown menu when the button is clicked
	{{$id}}dropdownButton.addEventListener('click', () => {
		{{$id}}dropdownMenu.classList.toggle('hidden');
	});

	// Hide the dropdown menu when the user clicks outside of it
	document.addEventListener('click', (event) => {
		if (!{{$id}}dropdownButton.contains(event.target) && !{{$id}}dropdownMenu.contains(event.target)) {
			{{$id}}dropdownMenu.classList.add('hidden');
		}
	});

	// set chosen option attribute
	{{$id}}items.forEach((item) => {
		item.addEventListener('click', () =>{
			{{$id}}dropdownContainer.setAttribute("{{$id}}-option", item.innerText);
		})
	});
</script>
@endpush