<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Modern E-Commerce') | Furniture & Living</title>
    <link href="{{ asset('public/assets/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0369a1',
                        secondary: '#075985',
                    },
                    container: {
                        center: true,
                        padding: '1rem',
                        screens: {
                            xl: '1200px',
                        },
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    @stack('styles')
</head>

<body class="font-sans text-gray-700 bg-white antialiased flex flex-col min-h-screen">

    {{-- Main Header --}}
    @include('partials.header')

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 container mx-auto my-4 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 container mx-auto my-4 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg"></i>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- Main Page Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Main Footer --}}
    @include('partials.footer')

    {{-- Back to Top Button --}}
    <button id="back-to-top" class="fixed bottom-6 right-6 w-11 h-11 bg-primary text-white rounded-full shadow-lg hidden items-center justify-center hover:bg-secondary transition duration-300 z-40">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mobile Menu Toggle
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const menuOverlay = document.getElementById('menu-overlay');
            const closeBtn = document.getElementById('close-menu-btn');

            if (mobileBtn && mobileSidebar && menuOverlay) {
                const toggleMenu = () => {
                    mobileSidebar.classList.toggle('-translate-x-full');
                    menuOverlay.classList.toggle('hidden');
                };
                mobileBtn.addEventListener('click', toggleMenu);
                if (closeBtn) closeBtn.addEventListener('click', toggleMenu);
                menuOverlay.addEventListener('click', toggleMenu);
            }

            // Back to top
            const backBtn = document.getElementById('back-to-top');
            if (backBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backBtn.classList.remove('hidden');
                        backBtn.classList.add('flex');
                    } else {
                        backBtn.classList.add('hidden');
                        backBtn.classList.remove('flex');
                    }
                });
                backBtn.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
