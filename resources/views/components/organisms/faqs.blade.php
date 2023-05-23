<section class="home-section">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">

        <div class="max-w-2xl mx-auto text-center">
            <x-heading level="1">Frequently Asked Questions</x-heading>
            <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do</p>
        </div>

        <x-accordion class="max-w-3xl mx-auto md:mt-16" titleTag="h5" 
            :children="[['How to create an account?', 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.'], 
                        ['how can i make payment using paypal?', 'lorem'],
                        ['how can i make payment using paypal?', 'lorem'],
                        ['how can i make payment using paypal?', 'lorem'],
                        ['how can i make payment using paypal?', 'lorem']
                        ]" 
            />

        <p class="text-center text-gray-600 textbase mt-9">Didn’t find the answer you are looking for? <a href="#" title="" class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 focus:text-blue-700 hover:underline">Contact our support</a></p>
    </div>
</section>