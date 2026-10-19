<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Admin Dashboard') | Surfside Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0369a1',
                        secondary: '#075985',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-100 font-sans text-gray-800 antialiased flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-gray-300 flex flex-col justify-between flex-shrink-0">
        <div>
            <div class="h-16 flex items-center px-6 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-wider text-white uppercase">
                    SURF<span class="text-primary">ADMIN</span>
                </a>
            </div>

            <nav class="p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} transition">
                    <i class="fa-solid fa-gauge-high text-sm"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.products') ? 'bg-primary text-white' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} transition">
                    <i class="fa-solid fa-couch text-sm"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders') ? 'bg-primary text-white' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} transition">
                    <i class="fa-solid fa-receipt text-sm"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.categories') ? 'bg-primary text-white' : 'hover:bg-gray-800 text-gray-400 hover:text-white' }} transition">
                    <i class="fa-solid fa-layer-group text-sm"></i>
                    <span>Kategori</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-xs font-semibold text-gray-400 hover:bg-gray-800 hover:text-white transition">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Web Toko</span>
            </a>
        </div>
    </aside>

    {{-- Content Area --}}
    <div class="flex-grow flex flex-col h-screen overflow-y-auto">
        {{-- Top Bar --}}
        <header class="h-16 bg-white border-b border-gray-200 px-8 flex items-center justify-between flex-shrink-0">
            <h1 class="text-base font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-gray-500">Administrator: <strong class="text-gray-800">Allam</strong></span>
                <div class="w-8 h-8 rounded-full bg-primary text-white font-bold text-xs flex items-center justify-center">
                    A
                </div>
            </div>
        </header>

        {{-- Main Body --}}
        <main class="p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
