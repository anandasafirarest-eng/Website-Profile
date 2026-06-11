@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data portofolio')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-navy/5 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-briefcase text-navy"></i>
                </div>
                <span class="text-xs font-semibold text-gold bg-gold/10 px-3 py-1 rounded-full">Total</span>
            </div>
            <p class="text-3xl font-bold text-navy">{{ $totalPortfolios }}</p>
            <p class="text-gray-400 text-sm mt-1">Portofolio</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-navy/5 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-images text-navy"></i>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Media</span>
            </div>
            <p class="text-3xl font-bold text-navy">{{ $totalGalleries }}</p>
            <p class="text-gray-400 text-sm mt-1">Item Gallery</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-navy/5 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-clock text-navy"></i>
                </div>
                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Terbaru</span>
            </div>
            <p class="text-lg font-bold text-navy truncate">{{ $latestPortfolio ? $latestPortfolio->judul : '-' }}</p>
            <p class="text-gray-400 text-sm mt-1">Portofolio terakhir</p>
        </div>
    </div>

    {{-- Quick Action --}}
    <div class="bg-gradient-to-br from-navy to-navy-light rounded-2xl p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-xl font-bold text-white mb-2">Tambah Karya Baru</h3>
            <p class="text-gray-400 text-sm">Tambahkan portofolio baru yang akan ditampilkan di halaman utama website.</p>
        </div>
        <a href="{{ route('admin.portfolios.create') }}"
           class="flex-shrink-0 bg-gradient-to-r from-gold to-amber-500 text-navy font-bold px-8 py-3.5 rounded-xl text-sm hover:shadow-lg hover:shadow-gold/20 transition-all hover:-translate-y-0.5">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Portofolio
        </a>
    </div>

    {{-- Recent Portfolios --}}
    @if($recentPortfolios->count() > 0)
    <div class="mt-10">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-navy">Portofolio Terbaru</h3>
            <a href="{{ route('admin.portfolios.index') }}" class="text-gold text-sm font-medium hover:text-navy transition-colors">
                Lihat Semua <i class="fa-solid fa-arrow-right text-xs ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recentPortfolios as $item)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                    <div class="w-12 h-12 bg-lightbg rounded-xl flex items-center justify-center mb-4 text-navy group-hover:bg-navy group-hover:text-gold transition-colors">
                        <i class="{{ $item->icon }} text-lg"></i>
                    </div>
                    <h4 class="font-bold text-navy mb-2">{{ $item->judul }}</h4>
                    <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $item->deskripsi }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">
                            <i class="fa-solid fa-images mr-1"></i> {{ $item->galleries_count }} media
                        </span>
                        <a href="{{ route('admin.portfolios.edit', $item) }}" class="text-gold text-sm font-medium hover:text-navy transition-colors">
                            Edit <i class="fa-solid fa-pen text-xs ml-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection
