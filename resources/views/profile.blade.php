@extends('components.layouts.master')

@section('content')
<div class="flex flex-no-wraph h-[calc(100vh-80px)]">

    {{-- sidebar --}}
    <div class="absolute flex-col justify-between hidden w-64 shadow bg-gray-50 sm:relative md:h-full sm:flex">
        {{-- side-bar links --}}
        <div class="px-8 mt-12">
            <div class="text-gray-400">
                Content
            </div>
            {{-- TODO: create component link component and pass an array to it to loop on it's elements --}}
            <x-button :isAnchor="true" format="tertiary" class="ml-2">
                State 1
            </x-button>
        </div>
    </div>

    {{-- TODO: mobie nav --}}
    {{-- <div class="absolute z-40 flex-col justify-between w-64 transition duration-150 ease-in-out bg-gray-800 shadow md:h-full sm:hidden" id="mobile-nav">
        <button aria-label="toggle sidebar" id="openSideBar" class="absolute right-0 flex items-center justify-center w-10 h-10 mt-16 -mr-10 bg-gray-800 rounded rounded-tr rounded-br shadow cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800" onclick="sidebarHandler(true)">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg7.svg" alt="toggler">
        </button>
        <button aria-label="Close sidebar" id="closeSideBar" class="absolute right-0 flex items-center justify-center hidden w-10 h-10 mt-16 -mr-10 text-white bg-gray-800 rounded-tr rounded-br shadow cursor-pointer" onclick="sidebarHandler(false)">
            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg8.svg" alt="cross">
        </button>
        <div class="px-8">
            <div class="flex items-center w-full h-16">
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg1.svg" alt="Logo">
            </div>
            <ul class="mt-12">
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:text-gray-500">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                            <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                            <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                            <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                        </svg>
                        <span class="ml-2 text-sm">Dashboard</span>
                    </a>
                    <div class="flex items-center justify-center px-3 py-1 text-xs bg-gray-600 rounded">5</div>
                </li>
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1"></path>
                        </svg>
                        <span class="ml-2 text-sm">Products</span>
                    </a>
                    <div class="flex items-center justify-center px-3 py-1 text-xs bg-gray-600 rounded">8</div>
                </li>
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <polyline points="8 16 10 10 16 8 14 14 8 16"></polyline>
                            <circle cx="12" cy="12" r="9"></circle>
                        </svg>
                        <span class="ml-2 text-sm">Performance</span>
                    </a>
                </li>
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <polyline points="7 8 3 12 7 16"></polyline>
                            <polyline points="17 8 21 12 17 16"></polyline>
                            <line x1="14" y1="4" x2="10" y2="20"></line>
                        </svg>
                        <span class="ml-2 text-sm">Deliverables</span>
                    </a>
                </li>
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1"></path>
                        </svg>
                        <span class="ml-2 text-sm">Invoices</span>
                    </a>
                    <div class="flex items-center justify-center px-3 py-1 text-xs bg-gray-600 rounded">25</div>
                </li>
                <li class="flex items-center justify-between w-full mb-6 cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <polyline points="12 4 4 8 12 12 20 8 12 4" />
                            <polyline points="4 12 12 16 20 12" />
                            <polyline points="4 16 12 20 20 16" />
                        </svg>
                        <span class="ml-2 text-sm">Inventory</span>
                    </a>
                </li>
                <li class="flex items-center justify-between w-full cursor-pointer hover:">
                    <a href="javascript:void(0)" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <span class="ml-2 text-sm">Settings</span>
                    </a>
                </li>
            </ul>
            <div class="flex justify-center w-full mt-48 mb-4">
                <div class="relative">
                    <div class="absolute inset-0 w-4 h-4 m-auto ml-4 ">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg2.svg" alt="Search">
                    </div>
                    <input class="w-full py-2 pl-10 text-sm text-gray-300 placeholder-gray-400 bg-gray-100 bg-gray-700 rounded focus:outline-none focus:ring-1 focus:ring-gray-100" type="text" placeholder="Search" />
                </div>
            </div>
        </div>
        <div class="px-8 border-t border-gray-700">
            <ul class="flex items-center justify-between w-full bg-gray-800">
                <li class="pt-5 pb-3 text-white cursor-pointer">
                    <button aria-label="show notifications" class="rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg3.svg" alt="notifications">
                    </button>
                </li>
                <li class="pt-5 pb-3 text-white cursor-pointer">
                    <button aria-label="open chats" class="rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg4.svg" alt="chat">
                    </button>
                </li>
                <li class="pt-5 pb-3 text-white cursor-pointer">
                    <button aria-label="open settings" class="rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg5.svg" alt="settings">
                    </button>
                </li>
                <li class="pt-5 pb-3 text-white cursor-pointer">
                    <button aria-label="open logs" class="rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom-svg6.svg" alt="drawer">
                    </button>
                </li>
            </ul>
        </div>
    </div> --}}

    {{-- content --}}
    <div class="container w-11/12 h-64 px-6 py-10 mx-auto md:w-4/5">
    </div>

</div>
@endsection