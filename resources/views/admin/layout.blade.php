<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Ananda Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0F172A',
                        'navy-light': '#1E293B',
                        'navy-lighter': '#334155',
                        gold: '#D4AF37',
                        'gold-light': '#E8C84A',
                        lightbg: '#F8FAFC',
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(212, 175, 55, 0.1);
            color: #D4AF37;
        }
        .sidebar-link.active {
            border-right: 3px solid #D4AF37;
        }
        .fade-in {
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .notification-enter {
            animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile sidebar */
        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }
        .sidebar-panel {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="bg-lightbg min-h-screen flex">

    {{-- Sidebar Desktop --}}
    <aside class="hidden lg:flex flex-col w-64 bg-navy min-h-screen fixed left-0 top-0 z-40">
        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/5">
            <a href="/" class="text-2xl font-serif font-bold text-white tracking-wide">
                Ananda<span class="text-gold">.</span>
            </a>
            <p class="text-gray-500 text-xs mt-1 tracking-wider uppercase">Admin Panel</p>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 py-6 px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-grid-2 w-5 text-center text-xs"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.portfolios.index') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase w-5 text-center text-xs"></i>
                Portofolio
            </a>
        </nav>

        {{-- Footer --}}
        <div class="px-4 py-4 border-t border-white/5">
            <a href="/" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-500 hover:text-gray-300 text-xs transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                Lihat Website
            </a>
        </div>
    </aside>

    {{-- Mobile Sidebar Overlay --}}
    <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

    {{-- Mobile Sidebar --}}
    <aside id="sidebar-mobile" class="sidebar-panel fixed left-0 top-0 bottom-0 w-64 bg-navy z-50 lg:hidden -translate-x-full">
        <div class="px-6 py-6 border-b border-white/5 flex justify-between items-center">
            <a href="/" class="text-2xl font-serif font-bold text-white tracking-wide">
                Ananda<span class="text-gold">.</span>
            </a>
            <button onclick="toggleSidebar()" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <nav class="py-6 px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-grid-2 w-5 text-center text-xs"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.portfolios.index') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase w-5 text-center text-xs"></i>
                Portofolio
            </a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 lg:ml-64">
        {{-- Top Header --}}
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    {{-- Mobile menu button --}}
                    <button onclick="toggleSidebar()" class="lg:hidden text-navy hover:text-gold transition-colors">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-navy">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-gray-400">@yield('page-subtitle', '')</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-3 text-sm text-gray-500">
                        <div class="w-8 h-8 bg-navy rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="font-medium text-navy">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="notification-enter mx-6 mt-4">
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-check text-white text-xs"></i>
                    </div>
                    <p class="text-emerald-700 text-sm font-medium">{{ session('success') }}</p>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-emerald-400 hover:text-emerald-600">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="notification-enter mx-6 mt-4">
                <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-xmark text-white text-xs"></i>
                    </div>
                    <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Page Content --}}
        <main class="p-6 fade-in">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const overlay = document.getElementById('sidebar-overlay');
            const sidebar = document.getElementById('sidebar-mobile');
            overlay.classList.toggle('hidden');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Auto-dismiss notifications after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.notification-enter').forEach(el => {
                el.style.transition = 'opacity 0.3s, transform 0.3s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 300);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
