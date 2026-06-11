@extends('admin.layout')

@section('title', 'Portofolio')
@section('page-title', 'Manajemen Portofolio')
@section('page-subtitle', 'Kelola semua karya yang tampil di homepage')

@section('content')
    {{-- Header Actions --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <p class="text-gray-500 text-sm">
            Menampilkan <span class="font-bold text-navy">{{ $portfolios->count() }}</span> portofolio
        </p>
        <a href="{{ route('admin.portfolios.create') }}"
           class="bg-gradient-to-r from-gold to-amber-500 text-navy font-bold px-6 py-3 rounded-xl text-sm hover:shadow-lg hover:shadow-gold/20 transition-all hover:-translate-y-0.5 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Portofolio
        </a>
    </div>

    {{-- Portfolio List --}}
    @if($portfolios->count() > 0)
        <div class="space-y-4">
            @foreach($portfolios as $item)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden group">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 p-6">
                        {{-- Icon --}}
                        <div class="w-14 h-14 bg-lightbg rounded-xl flex items-center justify-center text-navy flex-shrink-0 group-hover:bg-navy group-hover:text-gold transition-colors">
                            <i class="{{ $item->icon }} text-xl"></i>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-navy text-lg mb-1">{{ $item->judul }}</h3>
                            <p class="text-gray-400 text-sm line-clamp-1">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            <div class="flex items-center gap-4 mt-2">
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="fa-solid fa-images"></i> {{ $item->galleries_count }} media
                                </span>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="fa-regular fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.portfolios.edit', $item) }}"
                               class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-100 transition-colors"
                               title="Edit">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.portfolios.destroy', $item) }}"
                                  onsubmit="return confirm('Yakin ingin menghapus portofolio &quot;{{ $item->judul }}&quot;? Semua gallery di dalamnya juga akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-100 transition-colors"
                                        title="Hapus">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-16 text-center">
            <div class="w-20 h-20 bg-lightbg rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-briefcase text-3xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-bold text-navy mb-2">Belum Ada Portofolio</h3>
            <p class="text-gray-400 text-sm mb-8 max-w-md mx-auto">Mulai dengan menambahkan karya pertama yang akan ditampilkan di halaman utama website.</p>
            <a href="{{ route('admin.portfolios.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-gold to-amber-500 text-navy font-bold px-8 py-3.5 rounded-xl text-sm hover:shadow-lg hover:shadow-gold/20 transition-all">
                <i class="fa-solid fa-plus"></i> Tambah Portofolio Pertama
            </a>
        </div>
    @endif
@endsection
