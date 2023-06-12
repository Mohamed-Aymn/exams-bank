<header class="relative flex items-center justify-center h-screen bg-primary-color">
    <div class="container px-6 mx-auto">
        <div class="flex flex-col items-center py-6 lg:h-[36rem] lg:flex-row">
            {{-- title --}}
            {{-- <div class="w-11/12 mb-5 sm:w-2/3 sm:mb-10"> --}}
            <h1 class="text-white heading heading-1">
                The Freedom to Create the Pages You Want
                
            </h1>
            {{-- </div> --}}

            {{-- form --}}
            <div class="flex mt-8 lg:w-1/2 lg:justify-end lg:mt-0">
                <div class="w-full max-w-md bg-white rounded-lg dark:bg-gray-800">
                    <div class="px-6 py-8 text-center">
                        <h2 class="text-2xl font-semibold text-gray-700 dark:text-white fo">Sign In</h2>
                        <form action="/api/v1/users" method="POST">
                            @csrf
                            <div class="flex flex-col gap-2 mt-3">
                                <input class="input" type="text" placeholder="Email address" name="email" area-label="Email Address" />
                                <input class="input" type="password" placeholder="Password" name="password" area-label="Password" />
                                
                                <label for="remember" class="block">
                                    <input type="checkbox" name="remember" id="remember"> Remember me
                                </label>

                                <button type="submit" class="btn btn-primary">
                                    Sign in
                                </button>
                            </div>

                            <div class="flex flex-col items-start justify-start my-1">
                                <a class="a" href="#">
                                    Forget Password?
                                </a>
                                <div class="text-left">
                                    Don't have account?
                                    <a class="btn btn-tertiary" href="/signup">
                                        Create one.
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="absolute btn btn-circle animate-bounce bottom-4" id="downClick">
        <span class="fa-solid fa-angle-down" />
    </button>
</header> 


@push('scripts')
<script>    
    $('#downClick').on("click", function(){
        $('html, body').animate({
            scrollTop: $('#secondSection').offset().top
        }, 2000);
    })
    
    // TODO: type scroll to sceond section logic here, then after the second section is in view, hide that button
    // $(window).scroll(function() {
    //     var position = $(this).scrollTop();
    //     if (position > 500) {
    //         $('#downClick').css('display', 'none');
    //     } else {
    //         $('#downClick').css('display', 'block');
    //     }
    // })
</script>
@endpush