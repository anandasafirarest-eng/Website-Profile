<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        
        // Instruksi latar belakang agar AI tahu persis siapa kamu
        $instruksi = "Kamu adalah asisten AI virtual yang bertugas di website portofolio Ananda Safira Restiani (biasa dipanggil Nans). " .
                     "Gunakan bahasa yang santai, ramah, dan asyik. " .
                     "Fakta tentang Nans: Mahasiswi Teknologi Multimedia dan Broadcasting di Politeknik Elektronika Negeri Surabaya (PENS). " .
                     "Keahlian Nans: Desain grafis, pembuatan konten visual, pengeditan gambar, serta manajemen proyek. " .
                     "Pengalaman Nans: Aktif sebagai panitia DTMK EXPO 2026. " .
                     "Berikut adalah pesan atau pertanyaan dari pengunjung: " . $request->message;
        
        try {
            // URL Final menggunakan model yang TERBUKTI diizinkan: gemini-2.5-flash
            $response = Http::withoutVerifying()->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $instruksi]]]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya kurang mengerti pertanyaannya.';
                return response()->json(['reply' => nl2br($reply)]);
            } else {
                return response()->json(['reply' => 'Google Error: ' . $response->body()], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['reply' => 'Sistem Error: ' . $e->getMessage()], 500);
        }
    }
}