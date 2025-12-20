<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-3 transition-all duration-300" style="background-color: rgba(240, 226, 198, 0);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- DESKTOP GRID -->
        <div class="hidden sm:grid grid-cols-3 h-16 items-center">

            <!-- LEFT NAV -->
            <div class="flex items-center space-x-6 ">
                <a href="#" class="navlink text-black">BUY PERFUMES</a>
                <a href="#" class="navlink text-black   ">EXCLUSIVE</a>

                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="text-black hover:text-white text-sm font-medium flex items-center gap-1">
                        CATEGORIES
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu"
                        class="absolute left-0 mt-2 hidden w-36 rounded-md shadow-lg ring-1 ring-black/10" style="background-color: #F0E2C6;">
                        <a href="#" class="dropdown-item text-black">Wanita</a>
                        <a href="#" class="dropdown-item text-black">Pria</a>
                        <a href="#" class="dropdown-item text-black">Unisex</a>
                    </div>
                </div>
            </div>

            <!-- CENTER LOGO -->
            <div class="flex justify-center">
                <div class="flex flex-col justify-center items-center ">
                    <span class="brand text-black text-3xl font-bold tracking-wide leading-none">FLEURE</span>
                    <span class="brand1 text-black text-sm tracking-wide leading-none">PERFUMES</span>
                </div>
            </div>

            <!-- RIGHT NAV -->
            <div class="flex justify-end items-center space-x-6">
                <a href="#" class="navlink text-black">ABOUT</a>
                <a href="#" class="navlink text-black">CONTACT</a>

                <!-- CART ICON -->
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-7 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>

                <!-- USER ICON -->
                <a href="/user/dashboard" class="hover:opacity-70 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-7 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- MOBILE NAV -->
        <div class="sm:hidden flex h-16 items-center justify-between">

            <!-- LOGO MOBILE -->
            <div class="flex flex-col leading-tight">
                <span class="brand text-white text-lg font-bold tracking-wide">FLEURE</span>
                <span class="brand text-white text-lg tracking-wide">PARFUME</span>
            </div>

            <!-- HAMBURGER -->
            <button onclick="toggleMobile()" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden sm:hidden mt-3 space-y-2">
            <a href="#" class="mobile-item">BUY PERFUMES</a>
            <a href="#" class="mobile-item">EXCLUSIVE</a>

            <details class="mobile-dropdown">
                <summary class="mobile-item">CATEGORIES</summary>
                <div class="pl-4 space-y-1">
                    <a href="#" class="mobile-item">Wanita</a>
                    <a href="#" class="mobile-item">Pria</a>
                    <a href="#" class="mobile-item">Unisex</a>
                </div>
            </details>

            <a href="#" class="mobile-item">ABOUT</a>
            <a href="#" class="mobile-item">CONTACT</a>
        </div>

    </div>
</nav>