<footer class="bg-gray-900 text-gray-400 text-sm mt-16 pt-16 pb-12 border-t border-gray-800">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10">
        <div>
            <h3 class="text-white text-lg font-bold uppercase tracking-wider mb-4">SURFSIDE</h3>
            <p class="leading-relaxed mb-4 text-xs">
                Kurasi furnitur minimalis & modern berstandar estetika tinggi untuk hunian yang nyaman, fungsional, dan berkelanjutan.
            </p>
            <div class="flex space-x-3 text-gray-300">
                <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fa-brands fa-instagram text-xs"></i></a>
                <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fa-brands fa-x-twitter text-xs"></i></a>
            </div>
        </div>

        <div>
            <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Belanja</h4>
            <ul class="space-y-2 text-xs">
                <li><a href="{{ route('shop') }}" class="hover:text-white transition">Semua Produk</a></li>
                <li><a href="{{ route('shop', ['category' => 'living-room']) }}" class="hover:text-white transition">Living Room</a></li>
                <li><a href="{{ route('shop', ['category' => 'bedroom']) }}" class="hover:text-white transition">Bedroom</a></li>
                <li><a href="{{ route('shop', ['category' => 'home-lighting']) }}" class="hover:text-white transition">Lighting</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Customer Care</h4>
            <ul class="space-y-2 text-xs">
                <li><a href="{{ route('contact') }}" class="hover:text-white transition">Hubungi Kami</a></li>
                <li><a href="{{ route('cart') }}" class="hover:text-white transition">Keranjang Belanja</a></li>
                <li><a href="{{ route('wishlist') }}" class="hover:text-white transition">Daftar Keinginan</a></li>
                <li><a href="#" class="hover:text-white transition">Kebijakan Pengembalian</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Hubungi Kami</h4>
            <p class="text-xs leading-relaxed mb-2">
                <i class="fa-solid fa-location-dot mr-2 text-primary"></i> Jl. Raya Smart City No. 12, Jakarta
            </p>
            <p class="text-xs leading-relaxed mb-2">
                <i class="fa-solid fa-phone mr-2 text-primary"></i> +62 812-3456-7890
            </p>
            <p class="text-xs leading-relaxed">
                <i class="fa-solid fa-envelope mr-2 text-primary"></i> support@surfside.test
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-12 pt-6 border-t border-gray-800 text-center text-xs text-gray-500">
        © {{ date('Y') }} Surfside Media. All rights reserved. Laravel 13 Powered.
    </div>
</footer>
