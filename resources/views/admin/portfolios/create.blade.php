@extends('admin.layout')

@section('title', 'Tambah Portofolio')
@section('page-title', 'Tambah Portofolio')
@section('page-subtitle', 'Buat portofolio baru untuk ditampilkan di homepage')

@section('content')
    <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" id="portfolio-form">
        @csrf

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
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all"
                               placeholder="Contoh: Liputan Acara Wisuda 2026">
                    </div>

                    {{-- Icon --}}
                    <div>
                        <label for="icon" class="block text-sm font-semibold text-navy mb-2">
                            Icon (FontAwesome Class)
                        </label>
                        <div class="flex gap-3 items-start">
                            <div class="flex-1">
                                <input type="text" name="icon" id="icon" value="{{ old('icon', 'fa-solid fa-folder') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all"
                                       placeholder="fa-solid fa-camera" onchange="updateIconPreview()">
                                <p class="text-xs text-gray-400 mt-2">
                                    Pilih icon dari <a href="https://fontawesome.com/icons" target="_blank" class="text-gold hover:underline">fontawesome.com/icons</a>
                                </p>
                            </div>
                            <div id="icon-preview" class="w-12 h-12 bg-lightbg rounded-xl flex items-center justify-center text-navy flex-shrink-0 border border-gray-200">
                                <i class="fa-solid fa-folder text-lg"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-navy mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/10 focus:outline-none transition-all resize-none"
                                  placeholder="Jelaskan tentang portofolio ini...">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Gallery Section --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-navy flex items-center gap-2">
                        <i class="fa-solid fa-images text-gold"></i> Gallery / Media
                    </h3>
                    <button type="button" onclick="addGalleryItem()"
                            class="text-gold font-semibold text-sm hover:text-navy transition-colors flex items-center gap-1">
                        <i class="fa-solid fa-plus text-xs"></i> Tambah Media
                    </button>
                </div>

                <div id="gallery-container" class="space-y-4">
                    {{-- Gallery items will be added here dynamically --}}
                </div>

                <div id="empty-gallery" class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center">
                    <div class="w-14 h-14 bg-lightbg rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Belum ada media. Klik tombol di bawah untuk menambahkan.</p>
                    <button type="button" onclick="addGalleryItem()"
                            class="bg-lightbg text-navy font-medium px-5 py-2.5 rounded-xl text-sm hover:bg-gray-100 transition-colors">
                        <i class="fa-solid fa-plus mr-1"></i> Tambah Media Pertama
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4">
                <button type="submit"
                        class="bg-gradient-to-r from-gold to-amber-500 text-navy font-bold px-10 py-3.5 rounded-xl text-sm hover:shadow-lg hover:shadow-gold/20 transition-all hover:-translate-y-0.5">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Portofolio
                </button>
                <a href="{{ route('admin.portfolios.index') }}"
                   class="text-gray-400 hover:text-navy font-medium text-sm transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
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
            // Show empty state if no items left
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
