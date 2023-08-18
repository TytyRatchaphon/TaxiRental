<nav class="bg-white drop-shadow border-gray-200 overflow-hidden sticky top-0 z-50">
    <div class="my-2 transition flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="https://www.svgrepo.com/show/429168/fruit-lemon-slice.svg" class="h-10 mr-1.5 sm:h-10"
                alt="Logo">
            <span
                class="link link-underline link-underline-yellow text-[#F6D106] self-center text-xl font-semibold whitespace-nowrap hover:text-[#faea9d] hover:scale-105 mr-2 transition">HONEY
                LEMON</span>
        </a>

        @if (!auth()->check())
            <div class="flex items-center lg:order-2">
                <li class="hidden lg:flex justify-between space-x-2">
                    <a href="{{ url('/login') }}"
                        class="transition-transform duration-500 hover:scale-105 text-Black bg-[#fde047] hover:text-white font-medium rounded-lg text-sm  focus:ring-2 focus:ring-[#F6D106] px-5 py-1.5">
                        Sign In
                    </a>
                    <a href="{{ url('/register') }}"
                        class="transition-transform duration-500 hover:scale-105 text-Black hover:text-[#fde047] font-medium rounded-lg text-sm  focus:ring-2 focus:ring-[#F6D106] px-4 py-1.5">
                        Sign Up
                    </a>
                </li>
            </div>
        @endif

        @auth
            <div class="flex items-center space-x-3 lg:order-2">
                <img src="{{ asset('/storage/' . (auth()->user()->user_profile_img)) }}" alt="Profile Image"
                    class="h-8 w-8 rounded-full">
                <span class="text-Black text-sm font-medium mr-3">{{ auth()->user()->username }}</span>
                <a href="{{ route('logout') }}"
                    class="transition-transform duration-500 hover:scale-110 text-Black bg-[#fde047] hover:text-white font-medium rounded-lg text-sm  focus:ring-2 focus:ring-[#F6D106] px-3 py-1.5"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth

        <button data-collapse-toggle="mobile-menu-2" type="button"
            class="inline-flex items-center p-1.5 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="mobile-menu-2" aria-expanded="true">

            <span class="sr-only">Open main menu</span>

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd">

                </path>
            </svg>

            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd">
                </path>
            </svg>

        </button>

        @auth
            <div class="bg-[#F6D106] items-end justify-between hidden pt-2 pb-2 w-full lg:pt-0 lg:pb-0 lg:flex lg:w-auto lg:order-1"
                id="mobile-menu-2">
                <ul
                    class=" flex flex-col max-w-screen-xl mx-auto font-medium justify-between lg:flex-row lg:bg-white lg:space-x-8 lg:p-0 overflow-hidden">
                    
                    <li>
                        <a href="{{ url('/home') }}"
                            class="pl-3 lg:pl-0 nav-menu hover:text-white lg:hover:text-[#fde047] transition {{ request()->is('/') ? 'active' : '' }}">
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/events/create') }}"
                            class="pl-3 lg:pl-0 nav-menu hover:text-white lg:hover:text-[#fde047] transition {{ Route::currentRouteName() === 'songs.index' ? 'active' : '' }}">
                            Create Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}"
                            class="pl-3 lg:pl-0 nav-menu hover:text-white lg:hover:text-[#fde047] transition {{ request()->is('/') ? 'active' : '' }}">
                            My Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}"
                            class="pl-3 lg:pl-0 nav-menu hover:text-white lg:hover:text-[#fde047] transition {{ Route::currentRouteName() === 'songs.index' ? 'active' : '' }}">
                            Certificate
                        </a>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const button = document.querySelector("[data-collapse-toggle='mobile-menu-2']");
        const menu = document.getElementById("mobile-menu-2");

        button.addEventListener("click", function() {
            menu.classList.toggle("hidden");
            const expanded = menu.classList.contains("hidden") ? "false" : "true";
            button.setAttribute("aria-expanded", expanded);
        });
    });
</script>
