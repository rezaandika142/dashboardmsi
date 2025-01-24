<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('chatbot_reply')) {
    /**
     * Fungsi untuk mengirim pesan ke API chatbot dan menerima respons.
     *
     * @param string $message
     * @return string
     */
    function chatbot_reply(string $message): string
    {
        try {
            // Kirim permintaan ke API Chatbot
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('CHATBOT_API_KEY'), // Pastikan API Key sudah di .env
            ])->post('https://api.example.com/chat', [ // Ganti URL API sesuai kebutuhan
                'message' => $message,
            ]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return $response->json('reply'); // Ganti 'reply' sesuai dengan struktur JSON respons API
            } else {
                // Jika respons gagal, kembalikan pesan default
                return 'Maaf, saya tidak dapat memahami pesan Anda saat ini.';
            }
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Chatbot Error: ' . $e->getMessage());
            return 'Terjadi kesalahan. Silakan coba lagi.';
        }
    }
}
