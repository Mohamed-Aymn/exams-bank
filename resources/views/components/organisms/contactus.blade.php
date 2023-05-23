<x-molecules.home-section id="id">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="max-w-2xl mx-auto text-center">
            <x-heading level="1">Contact Us</x-heading>
            <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-500">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis.</p>
        </div>

        <div class="flex flex-col max-w-5xl gap-5 mx-auto mt-12 sm:mt-16">
            <div class="grid grid-cols-1 gap-6 px-8 text-center md:px-0 md:grid-cols-3">
                <x-card>
                    <div class="p-6">
                        <svg class="flex-shrink-0 w-10 h-10 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                            />
                        </svg>
                        <p class="mt-6 text-lg font-medium text-gray-900">+1-316-555-0116</p>
                        <p class="mt-1 text-lg font-medium text-gray-900">+1-446-526-0117</p>
                    </div>
                </x-card>
                <x-card>
                    <div class="p-6">
                        <svg class="flex-shrink-0 w-10 h-10 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-6 text-lg font-medium text-gray-900">contact@example.com</p>
                        <p class="mt-1 text-lg font-medium text-gray-900">hr@example.com</p>
                    </div>
                </x-card>
                <x-card>
                    <div class="p-6">
                        <svg class="flex-shrink-0 w-10 h-10 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="mt-6 text-lg font-medium leading-relaxed text-gray-900">8502 Preston Rd. Ingle, Maine 98380, USA</p>
                    </div>
                </x-card>
            </div>
            <x-card>
                <div class="px-6 py-12 sm:p-12">
                    <h3 class="text-3xl font-semibold text-center text-gray-900">Send us a message</h3>

                    <form action="#" method="POST" class="mt-14">
                        <div class="grid gap-x-5 gap-y-4">

                            <x-input type="text" placeholder="Enter your full name" aria-label="Full Name" />
                            <x-input type="password" placeholder="Enter your email" aria-label="Email"  />
                            <x-input class="col-span-2" type="text" placeholder="Enter message title" aria-label="Title"  />
                            <textarea name="" id="" placeholder="Message" class="block w-full px-4 py-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md resize-y sm:col-span-2 focus:outline-none focus:border-blue-600 caret-blue-600" rows="4"></textarea>
                            <x-button type="submit" class="w-full sm:col-span-2">
                                Send
                            </x-button>
                        </div>
                    </form>
                </div>
            </x-card>
        </div>
    </div>
</x-molecules.home-section>
