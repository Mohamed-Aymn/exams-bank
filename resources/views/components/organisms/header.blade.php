@php
    $userType = Auth::user()->type;
@endphp

<header class="relative flex justify-between items-center bg-white h-[80px] border-b border-gray-200 px-4 lg:px-8">

    {{-- logo --}}
    <a href="#" title="" class="flex">
        <img class="w-auto h-8 lg:h-10" src="{{ asset('assets/icon.svg') }}" alt="" />
    </a>
    {{-- small screens --}}
    <i class="cursor-pointer fa-solid fa-bars lg:hidden" id="mobile-menu-button"></i>
    <nav id="mobile-menu" class="absolute z-50 hidden pt-4 pb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden top-5 right-10">
        <div class="flex flex-col items-center justify-center gap-2 px-6 -my-2 space-y-1">
            @if($userType == "a")
                <a href="/bank" class="btn btn-nav">Bank</a>
                <a href="/users-list" class="btn btn-nav">Users</a> 
                <button open-create-modal class="btn btn-nav">Create</button>
                <a href="/manage" class="btn btn-nav">Manage</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "t")
                <a href="/create?option=question" class="btn btn-nav">Create</a>
                <a href="/profile" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "s")
                <a href="profile?id={{Auth::user()->user_id}}" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam</a>
            @endif
        </div>
    </nav>

    {{-- large screens --}}
    <nav class="navbar hidden h-16 lg:flex lg:h-20">
        <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-3">
            @if($userType == "a")
                <a href="/bank" class="btn btn-ghost">Bank</a>

                <details class="dropdown">
                <summary class="m-1 btn btn-ghost">Create</summary>
                <ul class="dropdown-content">
                    <li><a href="/create?option=question">Question</a></li>
                    <li><a href="/create?option=subject">Subject</a></li>
                </ul>
                </details>

                <details class="dropdown">
                    <summary class="m-1 btn btn-ghost">Manage</summary>
                    <ul class="dropdown-content">
                        <li><a href="/create?option=question">Question Requests</a></li>
                        <li><a href="/create?option=subject">Teacher Requests</a></li>
                        <li><a href="/users-list">Users</a></li>
                    </ul>
                </details>
            
                <a href="/profile" class="btn btn-ghost">profile</a>
                <a href="#" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "t")
                <a href="/create?option=question" class="btn btn-nav">Create</a>
                <a href="profile?id={{Auth::user()->user_id}}" class="btn btn-nav">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam Demo</a>
            @elseif($userType == "s")
                <a href="profile?id={{Auth::user()->user_id}}" class="btn btn-ghost">profile</a>
                <a href="/customize-exam" class="btn btn-primary">Exam</a>
            @endif
        </div>
        

    </nav>
</header>

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