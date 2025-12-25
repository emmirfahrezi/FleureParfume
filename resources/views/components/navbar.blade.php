<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

<style>
    .swal2-popup {
        font-family: 'Times New Roman', serif !important;
        border-radius: 0px !important;
        letter-spacing: 0.5px;
        padding: 2em !important;
    }

    .swal2-title {
        font-size: 26px !important;
        font-weight: 600 !important;
        color: #000 !important;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .swal2-confirm {
        background-color: #000000 !important;
        color: #ffffff !important;
        box-shadow: none !important;
        border-radius: 0px !important;
        text-transform: uppercase;
        font-size: 12px !important;
        letter-spacing: 1.5px;
        padding: 12px 35px !important;
        border: 1px solid #000 !important;
    }

    .swal2-cancel {
        background-color: transparent !important;
        color: #555 !important;
        box-shadow: none !important;
        font-size: 12px !important;
        text-decoration: underline;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-3 transition-all duration-300"
    style="background-color: rgba(240, 226, 198, 0);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="hidden sm:grid grid-cols-3 h-16 items-center">

            <div class="flex items-center space-x-6 ">
                <a href="/" class="navlink text-black hover:text-gray-600 transition-colors">BUY PERFUMES</a>
                <a href="#" class="navlink text-black hover:text-gray-600 transition-colors">EXCLUSIVE</a>

                <div class="relative">
                    <button id="cat-btn" onclick="toggleDropdown(event)"
                        class="text-black hover:text-gray-600 transition-colors text-sm font-medium flex items-center gap-1 focus:outline-none">
                        CATEGORIES
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu"
                        class="absolute left-0 mt-2 hidden w-36 rounded-md shadow-lg ring-1 ring-black/10"
                        style="background-color: #F0E2C6;">
                        <a href="#" class="dropdown-item text-black">Wanita</a>
                        <a href="#" class="dropdown-item text-black">Pria</a>
                        <a href="#" class="dropdown-item text-black">Unisex</a>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <a href="/" class="flex flex-col justify-center items-center group">
                    <span
                        class="brand text-black text-3xl font-bold tracking-widest leading-none group-hover:opacity-80 transition-opacity">FLEURE</span>
                    <span class="brand1 text-black text-xs tracking-[0.3em] leading-none mt-1">PERFUMES</span>
                </a>
            </div>

            <div class="flex justify-end items-center space-x-6">
                <a href="/about" class="navlink text-black hover:text-gray-600 transition-colors">ABOUT</a>
                <a href="/contact" class="navlink text-black hover:text-gray-600 transition-colors">CONTACT</a>

                <a href="{{ route('cart.index') }}" class="hover:opacity-70 transition-opacity" aria-label="Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>

                @guest
                    <a href="{{ route('login') }}" class="hover:opacity-70 transition-opacity" aria-label="Sign in">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>
                @else
                    <div class="relative">
                        <button id="user-btn" onclick="toggleUserMenu(event)"
                            class="hover:opacity-70 transition-opacity flex items-center focus:outline-none"
                            aria-label="User menu">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        <div id="user-menu"
                            class="hidden absolute right-0 mt-2 w-56 shadow-xl ring-1 ring-black/5 z-50 origin-top-right animate__animated animate__fadeInUp animate__faster"
                            style="background-color: #F0E2C6;">

                            <div class="px-4 py-4 border-b border-black/10">
                                <p class="text-xs text-gray-600 uppercase tracking-widest mb-1">Signed in as</p>
                                <p class="text-sm font-bold text-black truncate">{{ optional(auth()->user())->name }}</p>
                            </div>

                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-3 text-sm text-black hover:bg-black/5 transition-colors">
                                Your Profile
                            </a>
                            <a href="{{ route('pesanan.index') }}"
                                class="block px-4 py-3 text-sm text-black hover:bg-black/5 transition-colors">
                                Pesanan Saya
                            </a>

                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="button" onclick="confirmLogout()"
                                    class="w-full text-left px-4 py-3 text-sm text-black hover:bg-red-50 hover:text-red-700 transition-colors border-t border-black/5">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>

        <div class="sm:hidden flex h-16 items-center justify-between">
            <div class="flex flex-col leading-tight">
                <span class="brand text-black text-lg font-bold tracking-widest">FLEURE</span>
                <span class="brand text-black text-[10px] tracking-[0.3em]">PERFUMES</span>
            </div>
            <button onclick="toggleMobile()" class="text-black focus:outline-none p-2">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <div id="mobileMenu"
            class="hidden sm:hidden mt-4 pb-4 border-t border-black/10 space-y-1 bg-[#F0E2C6]/95 backdrop-blur-md rounded-b-lg shadow-lg">
            <a href="/" class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">BUY
                PERFUMES</a>
            <a href="#" class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">EXCLUSIVE</a>

            <details class="group">
                <summary
                    class="flex justify-between items-center px-4 py-3 text-base font-medium text-black cursor-pointer hover:bg-black/5">
                    CATEGORIES
                    <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>
                <div class="pl-8 bg-black/5 space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm text-black">Wanita</a>
                    <a href="#" class="block px-4 py-2 text-sm text-black">Pria</a>
                    <a href="#" class="block px-4 py-2 text-sm text-black">Unisex</a>
                </div>
            </details>

            <a href="#" class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">ABOUT</a>
            <a href="/contact" class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">CONTACT</a>
            <a href="{{ route('cart.index') }}"
                class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">CART</a>

            @auth
                <div class="border-t border-black/10 mt-2 pt-2">
                    <div class="px-4 py-2 text-xs text-gray-500 uppercase">Signed in as
                        {{ optional(auth()->user())->name }}</div>
                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">Profile</a>
                    <a href="{{ route('pesanan.index') }}"
                        class="block px-4 py-3 text-base font-medium text-black hover:bg-black/5">Pesanan Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>

    </div>
</nav>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'LOGOUT',
            text: "Are you sure you want to end your session?",
            icon: 'question',
            iconColor: '#000',
            background: '#F0E2C6',
            backdrop: `rgba(0,0,0,0.5) backdrop-filter: blur(8px)`,
            showCancelButton: true,
            confirmButtonText: 'YES, LOGOUT',
            cancelButtonText: 'CANCEL',
            reverseButtons: true,
            focusConfirm: false,
            showClass: {
                popup: 'animate__animated animate__fadeInUp animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutDown animate__faster'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'GOODBYE',
                    html: 'See you again...',
                    timer: 1500,
                    background: '#F0E2C6',
                    icon: 'success',
                    iconColor: '#000',
                    showConfirmButton: false
                }).then(() => {
                    document.getElementById('logout-form').submit();
                });
            }
        });
    }

    function toggleUserMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('user-menu');
        menu.classList.toggle('hidden');
        document.getElementById('dropdownMenu')?.classList.add('hidden');
    }

    function toggleDropdown(event) {
        event.stopPropagation();
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
        document.getElementById('user-menu')?.classList.add('hidden');
    }

    window.addEventListener('click', function(e) {
        const userMenu = document.getElementById('user-menu');
        const userBtn = document.getElementById('user-btn');
        const catMenu = document.getElementById('dropdownMenu');
        const catBtn = document.getElementById('cat-btn');

        if (userMenu && !userMenu.classList.contains('hidden')) {
            if (!userMenu.contains(e.target) && (!userBtn || !userBtn.contains(e.target))) {
                userMenu.classList.add('hidden');
            }
        }
        if (catMenu && !catMenu.classList.contains('hidden')) {
            if (!catMenu.contains(e.target) && (!catBtn || !catBtn.contains(e.target))) {
                catMenu.classList.add('hidden');
            }
        }
    });

    function toggleMobile() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
        if (!menu.classList.contains('hidden')) {
            menu.classList.add('animate__animated', 'animate__slideInDown', 'animate__faster');
        }
    }

    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 10) {
            navbar.style.backgroundColor = 'rgba(240, 226, 198, 0.95)';
            navbar.style.backdropFilter = 'blur(10px)';
            navbar.classList.add('shadow-sm');
        } else {
            navbar.style.backgroundColor = 'rgba(240, 226, 198, 0)';
            navbar.style.backdropFilter = 'none';
            navbar.classList.remove('shadow-sm');
        }
    });
</script>

@if (session('login_success') || session('register_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- TRIK BIAR VS CODE GA MERAH ---
            // Kita jadiin string dulu ("..."), baru dibandingin di JS

            // Ambil nama user dengan aman (optional)
            const userName = "{{ optional(auth()->user())->name ?? 'User' }}";

            // Cek apakah ini Register? (String comparison)
            const isRegister = "{{ session('register_success') ? 'yes' : 'no' }}" === "yes";

            // Default Text (Login)
            let titleText = 'WELCOME BACKK!';
            let bodyText = `Halo ${userName}, senang melihatmu kembali.`;
            let iconType = 'success';

            // Kalau Register Success
            if (isRegister) {
                titleText = 'WELCOME TO FLEURE!';
                bodyText = `Halo ${userName}, terima kasih sudah bergabung dengan keluarga Fleure Parfumes!`;
            }

            // Jalankan SweetAlert
            Swal.fire({
                title: titleText,
                text: bodyText,
                icon: iconType,
                iconColor: '#000',
                background: '#F0E2C6',
                backdrop: `rgba(0,0,0,0.4) backdrop-filter: blur(4px)`,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });
    </script>
@endif
