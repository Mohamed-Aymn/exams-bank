<header class="relative flex justify-between items-center bg-white lg:pb-0 h-[80px] border-b border-gray-200 px-4 max-w-7xl lg:px-8">

    {{-- logo --}}
    <div class="flex-shrink-0">
        <a href="#" title="" class="flex">
            <img class="w-auto h-8 lg:h-10" src="https://cdn.rareblocks.xyz/collection/celebration/images/logo.svg" alt="" />
        </a>
    </div>

    {{-- small screens --}}
    <i class="cursor-pointer fa-solid fa-bars lg:hidden" id="mobile-menu-button"></i>
    <nav id="mobile-menu" class="absolute hidden pt-4 pb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden top-5 right-10">
        <div class="flex flex-col items-center justify-center gap-2 px-6 -my-2 space-y-1">
            <x-nav-button href="/bank">Bank</x-nav-button>
            <x-nav-button href="/users">Users</x-nav-button>
            <x-nav-button href="/create">Create</x-nav-button>
            <x-nav-button href="/manage">Manage</x-nav-button>
            <x-nav-button href="/profile">profile</x-nav-button>
            <x-button format="primary"> Exam Demo </x-button>
        </div>
    </nav>

    {{-- large screens --}}
    <nav class="items-center justify-between hidden h-16 lg:flex lg:h-20">
        <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-10">
            <x-nav-button href="/bank">Bank</x-nav-button>
            <x-nav-button href="/users">Users</x-nav-button>
            <x-nav-button href="/create">Create</x-nav-button>
            <x-nav-button href="/manage">Manage</x-nav-button>
            <x-nav-button href="/profile">profile</x-nav-button>
            <x-button format="primary"> Exam Demo </x-button>
        </div>
    </nav>
    
</header>


@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle mobile menu when hamburger icon is clicked
        $('#mobile-menu-button').click(function() {
            $('#mobile-menu').toggleClass('hidden');
            // Toggle aria-expanded attribute
            var expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !expanded);
        });
    });
</script>
@endpush