<header class="relative flex justify-between items-center bg-white h-[80px] border-b border-gray-200 px-4 lg:px-8">

    {{-- logo --}}
    <a href="#" title="" class="flex">
        <img class="w-auto h-8 lg:h-10" src="https://cdn.rareblocks.xyz/collection/celebration/images/logo.svg" alt="" />
    </a>

    {{-- small screens --}}
    <i class="cursor-pointer fa-solid fa-bars lg:hidden" id="mobile-menu-button"></i>
    <nav id="mobile-menu" class="absolute hidden pt-4 pb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden top-5 right-10">
        <div class="flex flex-col items-center justify-center gap-2 px-6 -my-2 space-y-1">
            <a href="/bank" class="btn btn-nav">Bank</a>
            <a href="/userslist" class="btn btn-nav">Users</a>
            <a href="/create" class="btn btn-nav">Create</a>
            <a href="/manage" class="btn btn-nav">Manage</a>
            <a href="/profile" class="btn btn-nav">profile</a>
            <a href="#" class="btn btn-primary">Exam Demo</a>
        </div>
    </nav>

    {{-- large screens --}}
    <nav class="items-center justify-between hidden h-16 lg:flex lg:h-20">
        <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-10">
            <a href="/bank" class="btn btn-nav">Bank</a>
            <a href="/users" class="btn btn-nav">Users</a>
            <a href="/create" class="btn btn-nav">Create</a>
            <a href="/manage" class="btn btn-nav">Manage</a>
            <a href="/profile" class="btn btn-nav">profile</a>
            <a href="#" class="btn btn-primary">Exam Demo</a>
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