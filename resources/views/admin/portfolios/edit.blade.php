@extends('admin.layout')

@section('title', 'Edit Portofolio')
@section('page-title', 'Edit Portofolio')
@section('page-subtitle', 'Perbarui data portofolio "' . $portfolio->judul . '"')

@section('content')
    <div class="max-w-4xl">
        {{-- Back Button --}}
        <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-navy text-sm font-medium mb-6 transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar
        </a>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    <p class="text-red-700 font-semibold text-sm">Terjadi kesalahan:</p>
                </div>
                <ul class="text-red-600 text-sm list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Portfolio Info Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
                <h3 class="text-lg font-bold text-navy mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-gold"></i> Informasi Portofolio
                </h3>

                <div class="space-y-6">
                    {{-- Judul --}}
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-navy mb-2">
                            Judul <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $portfolio->judul) }}" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all">
                    </div>

                    {{-- Icon --}}
                    <div>
                        <label for="icon" class="block text-sm font-semibold text-navy mb-2">
                            Icon (FontAwesome Class)
                        </label>
                        <div class="flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="icon" id="icon" value="{{ old('icon', $portfolio->icon) }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all"
                                       onchange="updateIconPreview()">
                                <p class="text-xs text-gray-400 mt-2">
                                    Pilih icon dari <a href="https://fontawesome.com/icons" target="_blank" class="text-gold hover:underline">fontawesome.com/icons</a>
                                </p>
                            </div>
                            <div id="icon-preview" class="w-12 h-12 bg-lightbg rounded-xl flex items-center justify-center text-navy flex-shrink-0 border border-gray-200">
                                <i class="{{ $portfolio->icon }} text-lg"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-navy mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all resize-none">{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Existing Gallery --}}
            @if($portfolio->galleries->count() > 0)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
                <h3 class="text-lg font-bold text-navy mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-images text-gold"></i> Gallery Saat Ini
                    <span class="text-xs font-normal text-gray-400 bg-lightbg px-2 py-1 rounded-lg">{{ $portfolio->galleries->count() }} item</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($portfolio->galleries as $gallery)
                        <div class="relative group rounded-xl overflow-hidden bg-lightbg border border-gray-200">
                            @if($gallery->tipe_konten == 'gambar')
                                @if(str_starts_with($gallery->file_konten, 'http') || file_exists(public_path('assets/img/' . $gallery->file_konten)))
                                    <img src="{{ asset('assets/img/' . $gallery->file_konten) }}" class="w-full h-40 object-cover" alt="">
                                @else
                                    <img src="{{ asset('storage/portfolios/' . $gallery->file_konten) }}" class="w-full h-40 object-cover" alt="">
                                @endif
                            @elseif($gallery->tipe_konten == 'video')
                                <div class="w-full h-40 bg-navy/10 flex items-center justify-center">
                                    <i class="fa-solid fa-video text-2xl text-gray-400"></i>
                                </div>
                            @elseif($gallery->tipe_konten == 'video_link')
                                <div class="w-full h-40 bg-red-50 flex items-center justify-center">
                                    <i class="fa-brands fa-youtube text-3xl text-red-400"></i>
                                </div>
                            @endif

                            <div class="p-3 flex items-center justify-between">
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    @if($gallery->tipe_konten == 'gambar')
                                        <i class="fa-regular fa-image"></i> Gambar
                                    @elseif($gallery->tipe_konten == 'video')
                                        <i class="fa-solid fa-video"></i> Video
                                    @else
                                        <i class="fa-brands fa-youtube"></i> YouTube
                                    @endif
                                </span>

                                <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}"
                                      onsubmit="return confirm('Hapus media ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-7 h-7 bg-red-50 text-red-400 hover:text-red-600 hover:bg-red-100 rounded-lg flex items-center justify-center transition-colors">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add New Gallery Items --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-navy flex items-center gap-2">
                        <i class="fa-solid fa-plus-circle text-gold"></i> Tambah Media Baru
                    </h3>
                    <button type="button" onclick="addGalleryItem()"
                            class="text-gold font-semibold text-sm hover:text-navy transition-colors flex items-center gap-1">
                        <i class="fa-solid fa-plus text-xs"></i> Tambah
                    </button>
                </div>

                <div id="gallery-container" class="space-y-4">
                    {{-- Dynamic gallery items --}}
                </div>

                <div id="empty-gallery" class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center">
                    <p class="text-gray-400 text-sm mb-3">Klik tombol di bawah untuk menambahkan media baru.</p>
                    <button type="button" onclick="addGalleryItem()"
                            class="bg-lightbg text-navy font-medium px-5 py-2.5 rounded-xl text-sm hover:bg-gray-100 transition-colors">
                        <i class="fa-solid fa-plus mr-1"></i> Tambah Media
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4">
                <button type="submit"
                        class="bg-gradient-to-r from-gold to-amber-500 text-navy font-bold px-10 py-3.5 rounded-xl text-sm hover:shadow-lg hover:shadow-gold/20 transition-all hover:-translate-y-0.5">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.portfolios.index') }}"
                   class="text-gray-400 hover:text-navy font-medium text-sm transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    let galleryIndex = 0;

    function addGalleryItem() {
        document.getElementById('empty-gallery').style.display = 'none';

        const container = document.getElementById('gallery-container');
        const index = galleryIndex++;

        const item = document.createElement('div');
        item.className = 'gallery-item bg-lightbg rounded-xl p-5 border border-gray-200 relative';
        item.id = `gallery-item-${index}`;
        item.innerHTML = `
            <button type="button" onclick="removeGalleryItem(${index})"
                    class="absolute top-3 right-3 w-8 h-8 bg-white text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg flex items-center justify-center transition-colors shadow-sm">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-navy mb-2">Tipe Media</label>
                    <select name="gallery_tipe[]" onchange="toggleGalleryInput(${index}, this.value)"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none bg-white">
                        <option value="gambar">🖼️ Gambar</option>
                        <option value="video">🎬 Video (Upload)</option>
                        <option value="video_link">🔗 Video Link (YouTube)</option>
                    </select>
                </div>

                <div id="file-input-${index}">
                    <label class="block text-xs font-semibold text-navy mb-2">Upload File</label>
                    <input type="file" name="gallery_file[]" accept="image/*,video/*"
                           onchange="previewFile(${index}, this)"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-navy file:text-white hover:file:bg-gray-800 bg-white cursor-pointer">
                </div>

                <div id="link-input-${index}" class="hidden">
                    <label class="block text-xs font-semibold text-navy mb-2">URL YouTube</label>
                    <input type="url" name="gallery_link[]"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none bg-white"
                           placeholder="https://www.youtube.com/embed/...">
                </div>
            </div>

            <div id="preview-${index}" class="mt-3 hidden">
                <img src="" class="rounded-lg max-h-40 object-cover" alt="Preview">
            </div>
        `;

        container.appendChild(item);
    }

    function removeGalleryItem(index) {
        const item = document.getElementById(`gallery-item-${index}`);
        item.style.transition = 'opacity 0.2s, transform 0.2s';
        item.style.opacity = '0';
        item.style.transform = 'translateX(20px)';
        setTimeout(() => {
            item.remove();
            const container = document.getElementById('gallery-container');
            if (container.children.length === 0) {
                document.getElementById('empty-gallery').style.display = 'block';
            }
        }, 200);
    }

    function toggleGalleryInput(index, value) {
        const fileInput = document.getElementById(`file-input-${index}`);
        const linkInput = document.getElementById(`link-input-${index}`);
        const preview = document.getElementById(`preview-${index}`);

        if (value === 'video_link') {
            fileInput.classList.add('hidden');
            linkInput.classList.remove('hidden');
        } else {
            fileInput.classList.remove('hidden');
            linkInput.classList.add('hidden');
        }
        preview.classList.add('hidden');
    }

    function previewFile(index, input) {
        const preview = document.getElementById(`preview-${index}`);
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.classList.remove('hidden');
                    preview.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        }
    }

    function updateIconPreview() {
        const iconInput = document.getElementById('icon');
        const preview = document.getElementById('icon-preview');
        preview.innerHTML = `<i class="${iconInput.value} text-lg"></i>`;
    }
</script>
@endpush
