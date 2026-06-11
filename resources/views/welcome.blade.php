<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Portofolio profesional Ananda Safira Restiani — Multimedia Specialist, Produksi Visual, dan Eksekusi Kreatif.">
    <title>Portofolio | Ananda Safira Restiani</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">

    <script type="importmap">
    {
        "imports": {
            "three": "https://unpkg.com/three@0.160.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@0.160.0/examples/jsm/"
        }
    }
    </script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0F172A',
                        'navy-light': '#1E293B',
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
        body { background-color: #F8FAFC; color: #334155; font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* Particle Canvas */
        #particles-canvas { position: fixed; inset: 0; z-index: 0; pointer-events: none; }

        /* Scroll Reveal */
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #0F172A 0%, #334155 40%, #D4AF37 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 8px 32px rgba(15,23,42,0.06);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            background: rgba(255,255,255,0.85);
            box-shadow: 0 20px 60px rgba(15,23,42,0.12);
            transform: translateY(-6px);
        }

        /* 3D Tilt */
        .tilt-card { transform-style: preserve-3d; transition: transform 0.15s ease-out; }

        /* Typing Cursor */
        .typing-cursor { display: inline-block; width: 3px; height: 1.1em; background: #D4AF37; margin-left: 2px; animation: cursorBlink 1s infinite; vertical-align: text-bottom; }
        @keyframes cursorBlink { 0%,100% { opacity: 1; } 50% { opacity: 0; } }

        /* Nav shrink */
        .nav-scrolled { padding-top: 0.6rem !important; padding-bottom: 0.6rem !important; box-shadow: 0 4px 30px rgba(0,0,0,0.06); }

        /* Hero fade-in stagger */
        .hero-stagger > * { opacity: 0; transform: translateY(30px); animation: heroIn 0.8s cubic-bezier(0.16,1,0.3,1) forwards; }
        .hero-stagger > *:nth-child(1) { animation-delay: 0.1s; }
        .hero-stagger > *:nth-child(2) { animation-delay: 0.25s; }
        .hero-stagger > *:nth-child(3) { animation-delay: 0.4s; }
        .hero-stagger > *:nth-child(4) { animation-delay: 0.55s; }
        .hero-stagger > *:nth-child(5) { animation-delay: 0.7s; }
        @keyframes heroIn { to { opacity: 1; transform: translateY(0); } }

        /* 3D canvas container */
        #character-canvas { cursor: grab; touch-action: none; }
        #character-canvas:active { cursor: grabbing; }

        /* Portfolio card icon shimmer */
        .icon-shimmer { position: relative; overflow: hidden; }
        .icon-shimmer::after {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent 40%, rgba(212,175,55,0.1) 50%, transparent 60%);
            transform: translateX(-100%); transition: none;
        }
        .group:hover .icon-shimmer::after { animation: shimmer 0.8s forwards; }
        @keyframes shimmer { to { transform: translateX(100%); } }

        /* Mobile menu */
        .mobile-menu { transition: all 0.3s cubic-bezier(0.16,1,0.3,1); }
        .mobile-menu.closed { max-height: 0; opacity: 0; overflow: hidden; }
        .mobile-menu.open { max-height: 300px; opacity: 1; }

        /* TAMBAHAN BARU: CSS Untuk Tombol Template AI Chatbot */
        .template-container::-webkit-scrollbar { display: none; /* Sembunyikan scrollbar horizontal */ }
        .template-container { -ms-overflow-style: none; scrollbar-width: none; }
        .btn-template {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
    transition: background-color 0.3s;
}

.btn-template:hover {
    background-color: #d4af37; /* Warna emas/kuning menyesuaikan temamu */
    color: white;
}
    </style>
</head>
<body class="antialiased selection:bg-gold selection:text-white overflow-x-hidden">

    <canvas id="particles-canvas"></canvas>

    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-gray-100/50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#home" class="text-2xl font-serif font-bold text-navy tracking-wide">
                Nans<span class="text-gold">.</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="nav-link text-sm font-medium text-gray-500 hover:text-gold transition-colors relative">Home</a>
                <a href="#about" class="nav-link text-sm font-medium text-gray-500 hover:text-gold transition-colors relative">About</a>
                <a href="#experience" class="nav-link text-sm font-medium text-gray-500 hover:text-gold transition-colors relative">Experience</a>
                <a href="#portfolio" class="nav-link text-sm font-medium text-gray-500 hover:text-gold transition-colors relative">Portofolio</a>
                <a href="#contact" class="bg-navy text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition-all hover:shadow-lg hover:shadow-navy/20 hover:-translate-y-0.5">
                    Contact
                </a>
            </div>

            <button id="hamburger-btn" onclick="toggleMobileMenu()" class="md:hidden text-navy hover:text-gold transition-colors p-1">
                <i class="fa-solid fa-bars text-xl" id="hamburger-icon"></i>
            </button>
        </div>

        <div id="mobile-menu" class="mobile-menu closed md:hidden bg-white/95 backdrop-blur-xl border-t border-gray-100">
            <div class="px-6 py-4 space-y-3">
                <a href="#home" onclick="toggleMobileMenu()" class="block text-sm font-medium text-gray-600 hover:text-gold py-2 transition-colors">Home</a>
                <a href="#about" onclick="toggleMobileMenu()" class="block text-sm font-medium text-gray-600 hover:text-gold py-2 transition-colors">About</a>
                <a href="#experience" onclick="toggleMobileMenu()" class="block text-sm font-medium text-gray-600 hover:text-gold py-2 transition-colors">Experience</a>
                <a href="#portfolio" onclick="toggleMobileMenu()" class="block text-sm font-medium text-gray-600 hover:text-gold py-2 transition-colors">Work</a>
                <a href="#contact" onclick="toggleMobileMenu()" class="block bg-navy text-white text-center py-3 rounded-xl text-sm font-medium hover:bg-gray-800 transition-all">Contact</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10">
        <section id="home" class="max-w-6xl mx-auto px-6 pt-28 md:pt-36 pb-16 min-h-[90vh] flex items-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-8 items-center w-full">

                <div class="hero-stagger">
                    <div class="inline-flex items-center gap-2 bg-gold/10 text-gold px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-6">
                        <span class="w-2 h-2 bg-gold rounded-full animate-pulse"></span>
                        Portofolio Profesional
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-navy leading-[1.1] mb-6">
                        Menciptakan <br>
                        <span class="gradient-text">Visual</span>
                        <span class="text-gray-300 italic font-light"> & </span><br class="hidden sm:block">
                        Membangun <span class="gradient-text">Cerita.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-500 leading-relaxed mb-8 max-w-lg min-h-[80px]">
                        Halo, saya <span class="font-bold text-navy">Ananda Safira Restiani</span>.
                        <span id="typing-target"></span><span class="typing-cursor"></span>
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="#portfolio" class="group bg-navy text-white px-8 py-3.5 rounded-full font-medium hover:bg-gray-800 transition-all hover:shadow-xl hover:shadow-navy/20 hover:-translate-y-0.5 flex items-center gap-2">
                            Lihat Portofolio
                            <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-0.5 transition-transform"></i>
                        </a>
                        <a href="#contact" class="border-2 border-gray-200 text-navy px-8 py-3.5 rounded-full font-medium hover:border-gold hover:text-gold transition-all hover:-translate-y-0.5">
                            Hubungi Saya
                        </a>
                    </div>

                    <div class="flex items-center gap-4 mt-10">
                        <div class="flex -space-x-2">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-amber-400 flex items-center justify-center text-white text-xs font-bold border-2 border-white shadow-sm">I</div>
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-navy to-gray-700 flex items-center justify-center text-white text-xs font-bold border-2 border-white shadow-sm">
                                <i class="fa-solid fa-star text-[8px]"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400"><span class="text-navy font-semibold">Multimedia</span> · Photographer · Designer</p>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center reveal-right">
                    <div class="relative w-full max-w-md aspect-square">
                        <canvas id="character-canvas" class="w-full h-full rounded-3xl"></canvas>
                    </div>
                    <p class="text-xs text-gray-400 mt-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-hand-pointer"></i> Drag untuk memutar 3D ↻
                    </p>
                </div>
            </div>
        </section>

        <section id="about" class="relative z-10 py-16 md:py-20">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 glass-card rounded-3xl p-8 md:p-10 reveal">
                        <p class="text-gold font-semibold text-xs tracking-[0.2em] uppercase mb-3">Tentang Saya</p>
                        <h2 class="text-3xl font-serif font-bold text-navy mb-6">Designer & Photographer</h2>
                        <p class="text-gray-500 leading-relaxed text-sm md:text-base text-justify">
                            Saya adalah mahasiswa Multimedia Broadcasting di Politeknik Elektronika Negeri Surabaya (PENS) yang memiliki minat pada desain grafis, komunikasi visual, dan pembuatan konten digital. Saya memiliki keahlian dalam Adobe Creative Suite, fotografi, videografi, dan produksi multimedia, serta berpengalaman dalam penyiaran, manajemen acara, dan pengembangan konten.
                        </p>
                    </div>

                    <div class="space-y-8">
                        <div class="glass-card rounded-3xl p-8 reveal-right">
                            <h3 class="text-lg font-serif font-bold text-navy mb-5 border-b border-gray-200 pb-3">Education</h3>
                            <div class="mb-5 relative pl-4 border-l-2 border-gold/30">
                                <span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gold"></span>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-bold text-navy">2024 - Sekarang</span>
                                    <span class="bg-gold/10 text-gold text-[10px] font-bold px-2 py-0.5 rounded-full">Studying</span>
                                </div>
                                <p class="text-sm font-bold text-navy">Multimedia Broadcasting Technology</p>
                                <p class="text-xs text-gray-500">Politeknik Elektronika Negeri Surabaya (PENS)</p>
                            </div>
                            <div class="relative pl-4 border-l-2 border-gold/30">
                                <span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gray-300"></span>
                                <p class="text-xs font-bold text-navy mb-1">2020 - 2023</p>
                                <p class="text-sm font-bold text-navy">Multimedia</p>
                                <p class="text-xs text-gray-500">SMK Dr. Soetomo Surabaya</p>
                            </div>
                        </div>

                        <div class="glass-card rounded-3xl p-8 reveal-right" style="transition-delay: 0.1s">
                            <h3 class="text-lg font-serif font-bold text-navy mb-5 border-b border-gray-200 pb-3">Software Skills</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="w-10 h-10 rounded-xl bg-[#3B0059] text-[#E895FF] flex items-center justify-center font-bold text-sm shadow-sm" title="Premiere Pro">Pr</span>
                                <span class="w-10 h-10 rounded-xl bg-[#00005C] text-[#9999FF] flex items-center justify-center font-bold text-sm shadow-sm" title="After Effects">Ae</span>
                                <span class="w-10 h-10 rounded-xl bg-[#001E36] text-[#31A8FF] flex items-center justify-center font-bold text-sm shadow-sm" title="Photoshop">Ps</span>
                                <span class="w-10 h-10 rounded-xl bg-[#330000] text-[#FF9A00] flex items-center justify-center font-bold text-sm shadow-sm" title="Illustrator">Ai</span>
                                <span class="w-10 h-10 rounded-xl bg-white text-black border border-gray-200 flex items-center justify-center font-bold text-sm shadow-sm" title="Figma"><i class="fa-brands fa-figma"></i></span>
                                <span class="w-10 h-10 rounded-xl bg-[#EA7600] text-white flex items-center justify-center font-bold text-sm shadow-sm" title="Blender">B</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="experience" class="max-w-6xl mx-auto px-6 mb-24 md:mb-32 pt-16">
            <div class="text-center mb-16 reveal">
                <p class="text-gold font-semibold text-xs tracking-[0.2em] uppercase mb-3">Experience</p>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-navy mb-4">Relevant Experience</h2>
                <div class="w-16 h-1 bg-gradient-to-r from-gold to-amber-400 mx-auto rounded-full"></div>
            </div>

            <div class="max-w-5xl mx-auto relative">
                <div class="absolute left-[31px] md:left-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-gold via-gray-300 to-transparent transform md:-translate-x-1/2"></div>

                @php
                    // Array Data Baru: Dikelompokkan berdasarkan Kategori
                    $experiences = [
                        [
                            'category' => 'Internship Experience',
                            'modal_id' => 'modal-internship',
                            'items' => [
                                'PSSI Surabaya as a <strong>Media Broadcaster Intern</strong>',
                                'SWATV Smekdors Wani Televisi as a <strong>Broadcaster Intern</strong>',
                                'DBL Indonesia as a <strong>Live Streaming Broadcasting Intern</strong>'
                            ]
                        ],
                        [
                            'category' => 'Work Experience',
                            'modal_id' => 'modal-work',
                            'items' => [
                                'PT. Zona Karya Nusantara as a <strong>Marketplace Administrator</strong>',
                                'Multimedia Smekdors Production as a <strong>Multimedia Crew</strong>'
                            ]
                        ],
                        [
                            'category' => 'Organizational Experience',
                            'modal_id' => 'modal-organization',
                            'items' => [
                                'MMB Fest 2025 as a <strong>Event Division Member</strong>',
                                'DTMK EXPO 2026 as a <strong>Event Division Member</strong>'
                            ]
                        ]
                    ];
                @endphp

                @foreach($experiences as $index => $exp)
                <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-12 w-full">
                    
                    <div class="absolute left-[31px] md:left-1/2 top-10 md:top-auto w-5 h-5 bg-white border-4 border-gold rounded-full transform -translate-x-1/2 shadow-sm shadow-gold/40 z-10"></div>

                    <div class="hidden md:block md:w-[45%]"></div>

                    <button onclick="bukaModal('{{ $exp['modal_id'] }}')" class="w-full text-left pl-[75px] pr-0 py-2 md:p-0 md:w-[45%] {{ $index % 2 == 0 ? 'md:order-first md:mr-auto reveal-left' : 'md:ml-auto reveal-right' }} group cursor-pointer block">
                        
                        <div class="bg-white/90 backdrop-blur-xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 md:p-10 flex flex-col group-hover:-translate-y-2 group-hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] transition-all duration-400 h-full">
                            
                            <span class="inline-block bg-[#FFF9E6] text-[#D4AF37] text-sm md:text-base font-bold px-5 py-2.5 rounded-full mb-6 w-max shadow-sm">
                                {{ $exp['category'] }}
                            </span>
                            
                            <ul class="list-disc pl-5 text-navy space-y-3 mb-10 leading-relaxed text-sm md:text-base">
                                @foreach($exp['items'] as $item)
                                    <li>{!! $item !!}</li>
                                @endforeach
                            </ul>

                            <div class="mt-auto border-t-[1.5px] border-navy/90 pt-5 flex items-center text-gold font-bold text-base transition-colors duration-300">
                                <span class="tracking-wide">Lihat Detail</span> 
                                <i class="fa-solid fa-arrow-right-long ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                            </div>

                        </div>
                    </button>
                    
                </div>
                @endforeach
            </div>
        </section>

        <section id="portfolio" class="max-w-6xl mx-auto px-6 mb-24 md:mb-32 pt-16">
            <div class="flex items-center gap-6 mb-12 reveal">
                <div>
                    <p class="text-gold font-semibold text-xs tracking-[0.2em] uppercase mb-2">Portfolio</p>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-navy">Portofolio & Sertifikat</h2>
                </div>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ($portfolios as $index => $item)
                <div class="tilt-card glass-card rounded-2xl p-7 group reveal" style="transition-delay: {{ $index * 0.1 }}s">
                    <div class="icon-shimmer w-14 h-14 bg-gradient-to-br from-lightbg to-gray-100 rounded-2xl flex items-center justify-center mb-6 text-navy group-hover:bg-gradient-to-br group-hover:from-navy group-hover:to-navy-light group-hover:text-gold transition-all duration-500">
                        <i class="{{ $item->icon }} text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-navy mb-2 font-serif group-hover:text-gold transition-colors">{{ $item->judul }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-3 mb-6 leading-relaxed">{{ $item->deskripsi }}</p>
                    <button onclick="bukaModal('modal-{{ $item->id }}')" class="text-gold font-semibold text-sm hover:text-navy transition-colors flex items-center gap-2 group/btn">
                        Lihat Detail
                        <i class="fa-solid fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                    </button>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <div class="relative">
        <svg class="block w-full" viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="height:80px;">
            <path d="M0,60 C360,100 720,0 1080,60 C1260,90 1380,70 1440,60 L1440,100 L0,100 Z" fill="#0F172A"/>
        </svg>
    </div>
    <footer id="contact" class="bg-navy pt-12 pb-10 relative z-10">
        <div class="max-w-4xl mx-auto text-center px-6">
            <div class="inline-flex items-center gap-2 bg-white/5 text-gold px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-6 reveal">
                <i class="fa-regular fa-handshake"></i> Terbuka untuk Kolaborasi
            </div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4 reveal">Mari Bekerja Sama</h2>
            <p class="text-gray-400 mb-10 max-w-md mx-auto text-sm reveal">Terbuka untuk diskusi proyek baru, kolaborasi kreatif, atau sekadar menyapa.</p>

            <div class="flex justify-center gap-4 mb-16 reveal">
                <a href="mailto:anandasafirarest@gmail.com" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-gold hover:border-gold hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:shadow-gold/20">
                    <i class="fa-regular fa-envelope text-lg"></i>
                </a>
                <a href="https://wa.me/6289678865166" target="_blank" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-green-500 hover:border-green-500 hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:shadow-green-500/20">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
                <a href="https://www.instagram.com/anndsfra_" target="_blank" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-pink-500 hover:border-pink-500 hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:shadow-pink-500/20">
                    <i class="fa-brands fa-instagram text-lg"></i>
                </a>
                <a href="https://www.linkedin.com/in/anandasafira" target="_blank" class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-600 hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:shadow-blue-600/20">
                    <i class="fa-brands fa-linkedin-in text-lg"></i>
                </a>
            </div>

            <div class="border-t border-white/5 pt-6 flex flex-col justify-center items-center gap-4">
                <p class="text-gray-500 text-xs tracking-widest uppercase text-center">© 2026 Ananda Safira Restiani. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div id="modal-internship" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-navy/80 backdrop-blur-md" onclick="tutupModal('modal-internship')"></div>
        <div class="relative bg-white w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl flex flex-col transform scale-95 transition-transform duration-300" id="box-internship">
            <div class="sticky top-0 bg-white/90 backdrop-blur-lg border-b border-gray-100 p-6 flex justify-between items-center z-50 rounded-t-3xl">
                <h2 class="text-xl md:text-2xl font-serif font-bold text-navy">Internship Experience</h2>
                <button onclick="tutupModal('modal-internship')" class="w-10 h-10 bg-gray-100 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 md:p-8 space-y-8">
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Media Broadcaster Intern</h3>
                    <p class="text-gold font-medium text-sm mb-3">PSSI Surabaya | Nov 2021 - Dec 2021</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Managed live streaming broadcasts of football events through YouTube.</li>
                        <li>Assisted in delivering high-quality visual content to online audiences.</li>
                        <li>Collaborated with production crews to ensure smooth broadcasting operations.</li>
                        <li>Supported camera operation and live production activities.</li>
                    </ul>
                </div>
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Broadcaster Intern</h3>
                    <p class="text-gold font-medium text-sm mb-3">SWATV Smekdors Wani Televisi | Oct 2021 - Dec 2021</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Participated in broadcasting productions for sports and entertainment events.</li>
                        <li>Assisted in camera operation, event coverage, and multimedia production.</li>
                        <li>Collaborated with production teams to deliver engaging visual content.</li>
                        <li>Supported live broadcasting activities and technical operations.</li>
                    </ul>
                </div>
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Live Streaming Broadcasting Intern</h3>
                    <p class="text-gold font-medium text-sm mb-3">DBL Indonesia | Oct 2021 - Dec 2021</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Assisted in live streaming production for Honda DBL 2021 events.</li>
                        <li>Supported photography and videography activities during event coverage.</li>
                        <li>Coordinated with production teams to ensure successful broadcasts.</li>
                        <li>Contributed to event documentation and multimedia content creation.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-work" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-navy/80 backdrop-blur-md" onclick="tutupModal('modal-work')"></div>
        <div class="relative bg-white w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl flex flex-col transform scale-95 transition-transform duration-300" id="box-work">
            <div class="sticky top-0 bg-white/90 backdrop-blur-lg border-b border-gray-100 p-6 flex justify-between items-center z-50 rounded-t-3xl">
                <h2 class="text-xl md:text-2xl font-serif font-bold text-navy">Work Experience</h2>
                <button onclick="tutupModal('modal-work')" class="w-10 h-10 bg-gray-100 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 md:p-8 space-y-8">
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Marketplace Administrator</h3>
                    <p class="text-gold font-medium text-sm mb-3">PT. Zona Karya Nusantara | Feb 2024 - Present</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Managed product listings, stock availability, and promotional campaigns.</li>
                        <li>Implemented up-selling and cross-selling strategies to improve sales performance.</li>
                        <li>Handled customer inquiries and resolved marketplace-related issues.</li>
                    </ul>
                </div>
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Multimedia Crew</h3>
                    <p class="text-gold font-medium text-sm mb-3">Multimedia Smekdors Production | July 2021 - Dec 2022</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Created promotional content for company and client events.</li>
                        <li>Assisted in live broadcasting and multimedia production projects.</li>
                        <li>Collaborated with creative teams to produce engaging visual materials.</li>
                        <li>Supported event documentation and digital media activities.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-organization" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-navy/80 backdrop-blur-md" onclick="tutupModal('modal-organization')"></div>
        <div class="relative bg-white w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl flex flex-col transform scale-95 transition-transform duration-300" id="box-organization">
            <div class="sticky top-0 bg-white/90 backdrop-blur-lg border-b border-gray-100 p-6 flex justify-between items-center z-50 rounded-t-3xl">
                <h2 class="text-xl md:text-2xl font-serif font-bold text-navy">Organizational Experience</h2>
                <button onclick="tutupModal('modal-organization')" class="w-10 h-10 bg-gray-100 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 md:p-8 space-y-8">
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Event Division Member</h3>
                    <p class="text-gold font-medium text-sm mb-3">MMB Fest 2025 - Division Acara</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Assisted in planning and executing event activities.</li>
                        <li>Coordinated with committee members to ensure smooth event operations.</li>
                        <li>Supported promotional and communication activities.</li>
                    </ul>
                </div>
                <div class="border-l-2 border-gold pl-4">
                    <h3 class="text-lg font-bold text-navy">Event Division Member</h3>
                    <p class="text-gold font-medium text-sm mb-3">DTMK EXPO 2026 - Division Acara</p>
                    <ul class="list-disc pl-4 text-gray-500 text-sm md:text-base leading-relaxed space-y-1">
                        <li>Participated in event planning and execution.</li>
                        <li>Collaborated with multiple divisions during event preparation.</li>
                        <li>Assisted in media and documentation activities.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @foreach ($portfolios as $item)
    <div id="modal-{{ $item->id }}" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-navy/80 backdrop-blur-md" onclick="tutupModal('modal-{{ $item->id }}')"></div>
        <div class="relative bg-white w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl flex flex-col transform scale-95 transition-transform duration-300" id="box-{{ $item->id }}">
            <div class="sticky top-0 bg-white/90 backdrop-blur-lg border-b border-gray-100 p-6 flex justify-between items-center z-50 rounded-t-3xl">
                <h2 class="text-xl md:text-2xl font-serif font-bold text-navy">{{ $item->judul }}</h2>
                <button onclick="tutupModal('modal-{{ $item->id }}')" class="w-10 h-10 bg-gray-100 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 md:p-8">
                <p class="text-gray-500 leading-relaxed mb-8 text-sm">{{ $item->deskripsi }}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($item->galleries as $gal)
                        @php
                            $isOldPath = file_exists(public_path('assets/img/' . $gal->file_konten));
                            $mediaSrc = $isOldPath ? asset('assets/img/' . $gal->file_konten) : asset('storage/portfolios/' . $gal->file_konten);
                        @endphp
                        <div class="w-full rounded-2xl overflow-hidden bg-gray-50 relative flex items-center justify-center {{ $gal->tipe_konten != 'gambar' ? 'h-[250px]' : '' }}">
                            @if($gal->tipe_konten == 'gambar')
                                <img src="{{ $mediaSrc }}" loading="lazy" decoding="async" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500">
                            @elseif($gal->tipe_konten == 'video')
                                <video controls preload="none" class="w-full h-full object-cover">
                                    <source src="{{ $mediaSrc }}" type="video/mp4">
                                </video>
                            @elseif($gal->tipe_konten == 'video_link')
                                <iframe src="{{ $gal->file_konten }}" allowfullscreen loading="lazy" class="w-full h-full object-cover border-none"></iframe>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
    (function() {
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        const PARTICLE_COUNT = 60;
        const MAX_DIST = 120;

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.vx = (Math.random() - 0.5) * 0.4;
                this.vy = (Math.random() - 0.5) * 0.4;
                this.radius = Math.random() * 1.5 + 0.5;
                this.opacity = Math.random() * 0.3 + 0.1;
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(212, 175, 55, ${this.opacity})`;
                ctx.fill();
            }
        }

        for (let i = 0; i < PARTICLE_COUNT; i++) particles.push(new Particle());

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => { p.update(); p.draw(); });
            // Draw lines between nearby particles
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx*dx + dy*dy);
                    if (dist < MAX_DIST) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.strokeStyle = `rgba(212, 175, 55, ${0.06 * (1 - dist/MAX_DIST)})`;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animate);
        }
        animate();
    })();
    </script>

    <script>
    // ---- Scroll Reveal (Intersection Observer) ----
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));

    // ---- Navbar Scroll Effect ----
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        const navInner = navbar.querySelector('div');
        if (window.scrollY > 50) {
            navInner.classList.add('nav-scrolled');
            navbar.classList.remove('bg-white/70');
            navbar.classList.add('bg-white/90');
        } else {
            navInner.classList.remove('nav-scrolled');
            navbar.classList.add('bg-white/70');
            navbar.classList.remove('bg-white/90');
        }
    });

    // ---- Mobile Menu ----
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('hamburger-icon');
        menu.classList.toggle('closed');
        menu.classList.toggle('open');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
    }

    // ---- Typing Effect ----
    const typingStrings = [
        'Profesional di bidang Multimedia Broadcasting.',
        'Berfokus pada kualitas produksi visual.',
        'Siap berkolaborasi untuk proyek kreatif.'
    ];
    let typingIndex = 0, charIndex = 0, isDeleting = false;
    const typingTarget = document.getElementById('typing-target');

    function typeEffect() {
        const current = typingStrings[typingIndex];
        if (!isDeleting) {
            typingTarget.textContent = current.substring(0, charIndex + 1);
            charIndex++;
            if (charIndex === current.length) {
                isDeleting = true;
                setTimeout(typeEffect, 2500);
                return;
            }
        } else {
            typingTarget.textContent = current.substring(0, charIndex - 1);
            charIndex--;
            if (charIndex === 0) {
                isDeleting = false;
                typingIndex = (typingIndex + 1) % typingStrings.length;
            }
        }
        setTimeout(typeEffect, isDeleting ? 30 : 60);
    }
    setTimeout(typeEffect, 1200);

    // ---- 3D Tilt Cards ----
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            card.style.transform = `perspective(800px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) translateY(-6px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateY(0) rotateX(0) translateY(0)';
        });
    });

    // ---- Modal Functions ----
    function bukaModal(id) {
        const modal = document.getElementById(id);
        const box = document.getElementById('box-' + id.split('-')[1]);
        if(!modal || !box) return; // Prevent errors if modal doesn't exist
        modal.classList.remove('hidden');
        setTimeout(() => { modal.classList.remove('opacity-0'); box.classList.remove('scale-95'); box.classList.add('scale-100'); }, 10);
        document.body.style.overflow = 'hidden';
    }
    function tutupModal(id) {
        const modal = document.getElementById(id);
        const box = document.getElementById('box-' + id.split('-')[1]);
        if(!modal || !box) return;
        modal.classList.add('opacity-0');
        box.classList.remove('scale-100'); box.classList.add('scale-95');
        const videos = box.querySelectorAll('video');
        const iframes = box.querySelectorAll('iframe');
        videos.forEach(vid => vid.pause());
        iframes.forEach(iframe => { let src = iframe.src; iframe.src = src; });
        setTimeout(() => { modal.classList.add('hidden'); document.body.style.overflow = 'auto'; }, 300);
    }
    </script>

    <script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
    // TAMBAHAN BARU: Memanggil environment ruangan agar warna 3D tidak flat abu-abu
    import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js'; 

    try {
        const canvas = document.getElementById('character-canvas');
        const container = canvas.parentElement;

        // Scene
        const scene = new THREE.Scene();

        // Camera
        const camera = new THREE.PerspectiveCamera(40, 1, 0.1, 100);
        camera.position.set(0, 1.2, 7);

        // Renderer
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.0;
        renderer.outputColorSpace = THREE.SRGBColorSpace; 

        // ==========================================
        // ENVIRONMENT MAP (Penyelamat warna 3D!)
        // ==========================================
        const pmremGenerator = new THREE.PMREMGenerator(renderer);
        scene.environment = pmremGenerator.fromScene(new RoomEnvironment(), 0.04).texture;

        function updateSize() {
            const w = container.clientWidth;
            const h = container.clientHeight;
            renderer.setSize(w, h);
            camera.aspect = w / h;
            camera.updateProjectionMatrix();
        }
        updateSize();
        window.addEventListener('resize', updateSize);

        // Controls
        const controls = new OrbitControls(camera, canvas);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.enableZoom = false;
        controls.enablePan = false;
        controls.autoRotate = true;
        controls.autoRotateSpeed = 1.5;
        controls.minPolarAngle = Math.PI * 0.25;
        controls.maxPolarAngle = Math.PI * 0.75;
        controls.target.set(0, 1.0, 0);

        // Lighting (Diterangkan sedikit)
        const ambientLight = new THREE.AmbientLight(0xffffff, 1.5);
        scene.add(ambientLight);
        const dirLight = new THREE.DirectionalLight(0xffffff, 2.0);
        dirLight.position.set(5, 8, 5);
        scene.add(dirLight);

        // Platform (Alas berpijak)
        const platform = new THREE.Mesh(
            new THREE.CylinderGeometry(1.2, 1.2, 0.05, 32),
            new THREE.MeshStandardMaterial({ color: 0xD4AF37, transparent: true, opacity: 0.08 })
        );
        platform.position.y = -0.55;
        scene.add(platform);

        // =====================================
        // MEMUAT AVATAR CUSTOM
        // =====================================
        let customAvatar;
        const loader = new GLTFLoader();
        
        const modelUrl = "{{ asset('assets/models/avatarnans.glb') }}";

        loader.load(
            modelUrl,
            function (gltf) {
                customAvatar = gltf.scene;
                customAvatar.position.set(0, -0.5, 0); 
                customAvatar.scale.set(3.5, 3.5, 3.5); 

                // Memaksa material memunculkan tekstur aslinya
                customAvatar.traverse(function (node) {
                    if (node.isMesh && node.material) {
                        // Menurunkan metalness agar tekstur tidak tertutup pantulan gelap
                        node.material.metalness = 0.0; 
                        node.material.roughness = 1.0;
                        node.material.needsUpdate = true;
                    }
                });

                scene.add(customAvatar);
            },
            undefined,
            function (error) {
                console.error('Gagal memuat file avatarnans.glb:', error);
            }
        );

        // Animation Loop
        function animate() {
            requestAnimationFrame(animate);
            const t = Date.now() * 0.001;

            if (customAvatar) {
                customAvatar.position.y = -0.5 + Math.sin(t * 0.8) * 0.12; 
            }

            controls.update();
            renderer.render(scene, camera);
        }
        animate();

    } catch (e) {
        console.warn('Three.js failed:', e);
        document.getElementById('character-canvas').style.display = 'none';
    }
    </script>

    <button id="chat-toggle-btn" class="fixed bottom-6 right-6 w-14 h-14 bg-navy text-gold rounded-full shadow-2xl flex items-center justify-center hover:scale-110 hover:bg-navy-light transition-all duration-300 z-[999] group border border-gold/20">
        <i class="fa-solid fa-robot text-2xl group-hover:animate-bounce"></i>
    </button>

    <div id="chat-window" class="fixed bottom-24 right-6 w-80 sm:w-96 bg-white rounded-3xl shadow-2xl flex-col hidden z-[999] border border-gray-100 overflow-hidden transition-all duration-300 transform scale-95 opacity-0 origin-bottom-right">
        <div class="bg-navy p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gold rounded-full flex items-center justify-center text-white text-xs">
                    <i class="fa-solid fa-sparkles"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm">Nans AI Assistant</h3>
                    <p class="text-gold/80 text-xs">Selalu aktif</p>
                </div>
            </div>
            <button id="close-chat-btn" class="text-white/60 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div id="chat-box" class="h-80 bg-gray-50 p-4 overflow-y-auto flex flex-col gap-3 text-sm">
            <div class="flex items-start gap-2 max-w-[85%]">
                <div class="w-6 h-6 rounded-full bg-gold flex-shrink-0 flex items-center justify-center text-white text-[10px]">AI</div>
                <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm text-gray-600 border border-gray-100">
                    Halo! Saya asisten AI Ananda. Ada yang bisa saya bantu tentang portofolio atau pengalamannya?
                </div>
            </div>
        </div>

        <div class="template-container flex gap-2 overflow-x-auto p-3 bg-white border-t border-gray-100">
            <button type="button" class="btn-template flex-shrink-0" onclick="sendTemplate('Siapa itu Nans?')">Siapa itu Nans?</button>
            <button type="button" class="btn-template flex-shrink-0" onclick="sendTemplate('Apa saja keahlian Nans?')">Keahlian Nans?</button>
            <button type="button" class="btn-template flex-shrink-0" onclick="sendTemplate('Ceritakan pengalaman Nans!')">Pengalaman Nans?</button>
        </div>

        <div class="p-3 bg-white border-t border-gray-50">
            <form id="chat-form" class="flex items-center gap-2">
                <input type="text" id="chat-input" placeholder="Tanya sesuatu..." class="flex-grow bg-gray-100 px-4 py-2.5 rounded-full text-sm focus:outline-none focus:ring-1 focus:ring-gold text-gray-700" required autocomplete="off">
                <button type="submit" class="w-10 h-10 bg-gold text-white rounded-full flex items-center justify-center hover:bg-gold-light transition-colors flex-shrink-0">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const chatToggleBtn = document.getElementById('chat-toggle-btn');
        const chatWindow = document.getElementById('chat-window');
        const closeChatBtn = document.getElementById('close-chat-btn');
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatBox = document.getElementById('chat-box');

        // Buka/Tutup Chat
        function toggleChat() {
            if (chatWindow.classList.contains('hidden')) {
                chatWindow.classList.remove('hidden');
                setTimeout(() => { chatWindow.classList.remove('scale-95', 'opacity-0'); chatWindow.classList.add('scale-100', 'opacity-100'); }, 10);
            } else {
                chatWindow.classList.remove('scale-100', 'opacity-100');
                chatWindow.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { chatWindow.classList.add('hidden'); }, 300);
            }
        }

        chatToggleBtn.addEventListener('click', toggleChat);
        closeChatBtn.addEventListener('click', toggleChat);

        // Tambah pesan ke layar
        function appendMessage(sender, text) {
            const isUser = sender === 'user';
            const html = `
                <div class="flex items-start gap-2 max-w-[85%] ${isUser ? 'ml-auto flex-row-reverse' : ''}">
                    <div class="w-6 h-6 rounded-full ${isUser ? 'bg-navy' : 'bg-gold'} flex-shrink-0 flex items-center justify-center text-white text-[10px]">
                        ${isUser ? '<i class="fa-solid fa-user"></i>' : 'AI'}
                    </div>
                    <div class="${isUser ? 'bg-navy text-white rounded-tr-none' : 'bg-white text-gray-600 rounded-tl-none border border-gray-100'} p-3 rounded-2xl shadow-sm">
                        ${text}
                    </div>
                </div>
            `;
            chatBox.insertAdjacentHTML('beforeend', html);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // FUNGSI BARU: Untuk Mengirim Teks dari Tombol Template
        // Fungsi untuk mengirim pesan dari tombol template
    function sendTemplate(question) {
    // Cari elemen input text kamu (pastikan ID-nya sesuai dengan punyamu, misal 'chat-input')
    let inputField = document.querySelector('input[type="text"]'); 
    
    // Cari tombol kirim (pastikan ID/Class-nya sesuai dengan punyamu)
    let sendButton = document.querySelector('.btn-send'); 

    if(inputField) {
        inputField.value = question; // Masukkan teks ke dalam kotak
        
        // Memicu klik pada tombol kirim secara otomatis
        if(sendButton) {
            sendButton.click(); 
        }
    }
}

        // Kirim Pesan ke Server
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;

            // 1. Tampilkan pesan user
            appendMessage('user', message);
            chatInput.value = '';
            
            // Tampilkan indikator loading AI
            const loadingId = 'loading-' + Date.now();
            const loadingHtml = `
                <div id="${loadingId}" class="flex items-start gap-2 max-w-[85%]">
                    <div class="w-6 h-6 rounded-full bg-gold flex-shrink-0 flex items-center justify-center text-white text-[10px]">AI</div>
                    <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-none shadow-sm text-gray-400 border border-gray-100 flex gap-1 items-center">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    </div>
                </div>
            `;
            chatBox.insertAdjacentHTML('beforeend', loadingHtml);
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                // 2. Tembak API ke Laravel
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const response = await fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                
                // Hapus loading
                document.getElementById(loadingId).remove();
                
                // 3. Tampilkan balasan AI
                appendMessage('ai', data.reply || 'Terjadi kesalahan sistem.');
            } catch (error) {
                document.getElementById(loadingId).remove();
                appendMessage('ai', 'Maaf, gagal menghubungi server.');
            }
        });
    </script>

</body>
</html>