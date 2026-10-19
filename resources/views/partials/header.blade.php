<header class="hidden lg:block bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto py-3">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <div class="w-1/4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-black tracking-wider text-gray-900 uppercase">
                        SURF<span class="text-primary">SIDE</span>
                    </span>
                </a>
            </div>

            {{-- Main Navigation --}}
            <div class="w-1/2 flex justify-center">
                <nav>
                    <ul class="flex space-x-8 font-medium text-sm text-gray-700">
                        <li>
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-primary' }} transition">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'text-primary font-bold' : 'hover:text-primary' }} transition">Shop</a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'text-primary font-bold' : 'hover:text-primary' }} transition">Cart</a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist') }}" class="{{ request()->routeIs('wishlist') ? 'text-primary font-bold' : 'hover:text-primary' }} transition">Wishlist</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-primary font-bold' : 'hover:text-primary' }} transition">Contact</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="text-amber-600 hover:text-amber-700 font-semibold transition flex items-center space-x-1">
                                <i class="fa-solid fa-gauge text-xs"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            {{-- Action Icons & Search --}}
            <div class="w-1/4 flex justify-end items-center space-x-6">
                {{-- Search Box --}}
                <div class="relative group">
                    <button class="text-xl text-gray-600 hover:text-primary transition" title="Cari Produk">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="absolute right-0 mt-3 w-72 bg-white border border-gray-200 shadow-xl p-3 rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <form action="{{ route('shop') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari furniture, lampu..." class="w-full border border-gray-200 rounded-l px-3 py-1.5 text-xs outline-none focus:border-primary" />
                            <button type="submit" class="bg-primary text-white px-3 py-1.5 rounded-r hover:bg-secondary transition text-xs">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Wishlist --}}
                <a href="{{ route('wishlist') }}" class="text-xl text-gray-600 hover:text-primary transition" title="Wishlist">
                    <i class="fa-regular fa-heart"></i>
                </a>

                {{-- Cart Bag with Dynamic Badge --}}
                <a href="{{ route('cart') }}" class="text-xl text-gray-600 hover:text-primary relative transition" title="Keranjang Belanja">
                    <i class="fa-solid fa-bag-shopping"></i>
                    @php
                        $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2.5 bg-primary text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>

{{-- Mobile Header --}}
<div class="lg:hidden bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50 px-4 py-3 flex justify-between items-center">
    <button id="mobile-menu-btn" class="text-xl text-gray-700">
        <i class="fa-solid fa-bars"></i>
    </button>
    <a href="{{ route('home') }}" class="text-xl font-black uppercase tracking-wider text-gray-900">
        SURF<span class="text-primary">SIDE</span>
    </a>
    <a href="{{ route('cart') }}" class="text-xl text-gray-700 relative">
        <i class="fa-solid fa-bag-shopping"></i>
        @if(isset($cartCount) && $cartCount > 0)
            <span class="absolute -top-2 -right-2.5 bg-primary text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">
                {{ $cartCount }}
            </span>
        @endif
    </a>
</div>

{{-- Mobile Sidebar Drawer --}}
<div id="menu-overlay" class="fixed inset-0 bg-black/50 z-50 hidden transition-opacity"></div>
<div id="mobile-sidebar" class="fixed top-0 left-0 bottom-0 w-72 bg-white z-50 shadow-2xl transform -translate-x-full transition-transform duration-300 p-6 flex flex-col justify-between">
    <div>
        <div class="flex justify-between items-center pb-4 border-b">
            <span class="text-lg font-bold text-gray-900">Menu</span>
            <button id="close-menu-btn" class="text-gray-500 hover:text-gray-800 text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <nav class="mt-6">
            <ul class="space-y-4 font-medium text-gray-700">
                <li><a href="{{ route('home') }}" class="block hover:text-primary">Home</a></li>
                <li><a href="{{ route('shop') }}" class="block hover:text-primary">Shop</a></li>
                <li><a href="{{ route('cart') }}" class="block hover:text-primary">Cart</a></li>
                <li><a href="{{ route('wishlist') }}" class="block hover:text-primary">Wishlist</a></li>
                <li><a href="{{ route('contact') }}" class="block hover:text-primary">Contact</a></li>
                <li><a href="{{ route('admin.dashboard') }}" class="block text-amber-600 font-semibold">Admin Panel</a></li>
            </ul>
        </nav>
    </div>
    <div class="pt-6 border-t text-xs text-gray-400">
        © {{ date('Y') }} Surfside Media. All rights reserved.
    </div>
</div>
