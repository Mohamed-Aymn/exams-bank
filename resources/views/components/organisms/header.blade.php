@php
    $userType = Auth::user()->type;
@endphp

<header class="relative flex justify-between items-center bg-white h-[80px] border-b border-gray-200 px-4 lg:px-8">

    {{-- logo --}}
    <a href="#" title="" class="flex">
        <img class="w-auto h-8 lg:h-10" src="https://cdn.rareblocks.xyz/collection/celebration/images/logo.svg" alt="" />
    </a>
    {{-- small screens --}}
    <i class="cursor-pointer fa-solid fa-bars lg:hidden" id="mobile-menu-button"></i>
    <nav id="mobile-menu" class="absolute hidden pt-4 pb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden top-5 right-10">
        <div class="flex flex-col items-center justify-center gap-2 px-6 -my-2 space-y-1">
            @if($userType == "a")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/bank" class="btn btn-nav">Bank</a>
                <a href="/users-list" class="btn btn-nav">Users</a>
                <button open-create-modal class="btn btn-nav">Create</button>
                <a href="/manage" class="btn btn-nav">Manage</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "t")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/create?option=question" class="btn btn-nav">Create</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "s")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam</a>
            @endif
        </div>
    </nav>

    {{-- large screens --}}
    <nav class="items-center justify-between hidden h-16 lg:flex lg:h-20">
        <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-10">
            @if($userType == "a")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/bank" class="btn btn-nav">Bank</a>
                <a href="/users-list" class="btn btn-nav">Users</a>
                <a href="/create" class="btn btn-nav">Create</a>
                <a href="/manage" class="btn btn-nav">Manage</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="#" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "t")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/create" class="btn btn-nav">Create</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="#" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "s")
                <a href="/auth/logout" class="btn btn-nav">logout</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="#" class="btn btn-primary">Exam</a>
            @endif
        </div>
    </nav>
</header>


<dialog create-modal class="card">
    <p>Choose what do you want to create!</p>
    <div class="flex flex-col items-center justify-center my-6">
        {{-- <x-toggle id="createToggle" firstOption="Question" secondOption="Subject"></x-toggle> --}}
    </div>
    <div class="flex flex-col gap-2 mt-2">
        <a id="createBtn" class="text-center btn btn-primary">Create</a>
        <button close-create-modal class="btn btn-tertiary">Cancel</button>
    </div>
</dialog>


@push('scripts')
<script>
    // create option model (only for admin users)
    @if($userType == "a")
        // create modal script
        const openButton = document.querySelector("[open-create-modal]");
        const closeButton = document.querySelector("[close-create-modal]");
        const createModal = document.querySelector("[create-modal]");
        openButton.addEventListener("click",() =>{
            createModal.showModal();
        })
        closeButton.addEventListener("click",() =>{
            createModal.close();
        })

        // toggle button in create modal
        const toggleBtn = document.querySelector("#createToggle");
        const CreateBtn = document.querySelector("#createBtn");
        CreateBtn.setAttribute('href', '/create?option=question');
        toggleBtn.addEventListener('change', function() {
            if (this.checked) {
                CreateBtn.setAttribute('href', '/create?option=question');
            } else {
                CreateBtn.setAttribute('href', '/create?option=subject');
            }
        });
    @endif

    // hamburger menu
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