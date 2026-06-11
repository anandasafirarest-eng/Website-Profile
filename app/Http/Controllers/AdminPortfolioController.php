<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPortfolioController extends Controller
{
    /**
     * Dashboard / daftar semua portofolio.
     */
    public function index()
    {
        $portfolios = Portfolio::withCount('galleries')->latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Form tambah portofolio baru.
     */
    public function create()
    {
        return view('admin.portfolios.create');
    }

    /**
     * Simpan portofolio baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'gallery_tipe.*' => 'nullable|string|in:gambar,video,video_link',
            'gallery_file.*' => 'nullable|file|max:51200', // max 50MB
            'gallery_link.*' => 'nullable|string|url:http,https',
        ]);

        $portfolio = Portfolio::create([
            'judul' => $request->judul,
            'icon' => $request->icon ?? 'fa-solid fa-folder',
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan gallery items
        $this->saveGalleryItems($request, $portfolio);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio "' . $portfolio->judul . '" berhasil ditambahkan!');
    }

    /**
     * Form edit portofolio.
     */
    public function edit(Portfolio $portfolio)
    {
        $portfolio->load('galleries');
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update data portofolio.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'gallery_tipe.*' => 'nullable|string|in:gambar,video,video_link',
            'gallery_file.*' => 'nullable|file|max:51200',
            'gallery_link.*' => 'nullable|string|url:http,https',
        ]);

        $portfolio->update([
            'judul' => $request->judul,
            'icon' => $request->icon ?? $portfolio->icon,
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan gallery items baru (jika ada)
        $this->saveGalleryItems($request, $portfolio);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio "' . $portfolio->judul . '" berhasil diperbarui!');
    }

    /**
     * Hapus portofolio beserta gallery-nya.
     */
    public function destroy(Portfolio $portfolio)
    {
        // Hapus file gallery dari storage
        foreach ($portfolio->galleries as $gallery) {
            if ($gallery->tipe_konten !== 'video_link') {
                Storage::disk('public')->delete('portfolios/' . $gallery->file_konten);
            }
        }

        $judul = $portfolio->judul;
        $portfolio->delete(); // Gallery otomatis terhapus karena onDelete('cascade')

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio "' . $judul . '" berhasil dihapus!');
    }

    /**
     * Hapus satu item gallery.
     */
    public function destroyGallery(PortfolioGallery $gallery)
    {
        if ($gallery->tipe_konten !== 'video_link') {
            Storage::disk('public')->delete('portfolios/' . $gallery->file_konten);
        }

        $gallery->delete();

        return back()->with('success', 'Item gallery berhasil dihapus!');
    }

    /**
     * Helper: Simpan gallery items dari request.
     */
    private function saveGalleryItems(Request $request, Portfolio $portfolio): void
    {
        if (!$request->has('gallery_tipe')) {
            return;
        }

        foreach ($request->gallery_tipe as $index => $tipe) {
            if (empty($tipe)) {
                continue;
            }

            $fileKonten = null;

            if ($tipe === 'video_link') {
                // Untuk YouTube link, simpan URL langsung
                $fileKonten = $request->gallery_link[$index] ?? null;
            } else {
                // Untuk gambar & video, upload file
                if ($request->hasFile("gallery_file.{$index}")) {
                    $file = $request->file("gallery_file.{$index}");
                    $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();
                    $file->storeAs('portfolios', $filename, 'public');
                    $fileKonten = $filename;
                }
            }

            if ($fileKonten) {
                PortfolioGallery::create([
                    'portfolio_id' => $portfolio->id,
                    'tipe_konten' => $tipe,
                    'file_konten' => $fileKonten,
                ]);
            }
        }
    }
}