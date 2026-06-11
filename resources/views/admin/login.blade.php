<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Ananda</title>
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
                        gold: '#D4AF37',
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
        .login-card {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bg-grid {
            background-image:
                linear-gradient(rgba(212, 175, 55, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212, 175, 55, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }
        .glow-btn {
            transition: all 0.3s ease;
        }
        .glow-btn:hover {
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.3);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen bg-navy bg-grid flex items-center justify-center p-4">

    {{-- Decorative elements --}}
    <div class="fixed top-0 right-0 w-96 h-96 bg-gold/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 bg-gold/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

    <div class="login-card w-full max-w-md relative">
        {{-- Logo --}}
        <div class="text-center mb-10">
            <a href="/" class="inline-block text-3xl font-serif font-bold text-white tracking-wide">
                Ananda<span class="text-gold">.</span>
            </a>
            <p class="text-gray-400 text-sm mt-2 tracking-wide">Admin Panel</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white/[0.05] backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white mb-1">Selamat Datang</h1>
                <p class="text-gray-400 text-sm">Masuk untuk mengelola portofolio</p>
            </div>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                    <p class="text-red-300 text-sm">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="space-y-5">
                    {{-- Email --}}
                    <div>
                        <label class="block text-gray-300 text-xs font-semibold tracking-wider uppercase mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <i class="fa-regular fa-envelope text-sm"></i>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="input-focus w-full bg-white/[0.06] border border-white/10 text-white rounded-xl pl-11 pr-4 py-3.5 text-sm placeholder-gray-500 focus:border-gold/50 focus:outline-none transition-all"
                                placeholder="admin@ananda.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-gray-300 text-xs font-semibold tracking-wider uppercase mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </span>
                            <input type="password" name="password" required id="password-field"
                                class="input-focus w-full bg-white/[0.06] border border-white/10 text-white rounded-xl pl-11 pr-11 py-3.5 text-sm placeholder-gray-500 focus:border-gold/50 focus:outline-none transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition-colors">
                                <i class="fa-regular fa-eye text-sm" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-white/20 bg-white/5 text-gold focus:ring-gold/30">
                        <label for="remember" class="text-gray-400 text-sm">Ingat saya</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="glow-btn w-full bg-gradient-to-r from-gold to-amber-500 text-navy font-bold py-3.5 rounded-xl text-sm tracking-wide">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk
                    </button>
                </div>
            </form>
        </div>

        {{-- Back to site --}}
        <div class="text-center mt-6">
            <a href="/" class="text-gray-500 text-sm hover:text-gold transition-colors">
                <i class="fa-solid fa-arrow-left mr-1 text-xs"></i> Kembali ke situs
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const field = document.getElementById('password-field');
            const icon = document.getElementById('eye-icon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
