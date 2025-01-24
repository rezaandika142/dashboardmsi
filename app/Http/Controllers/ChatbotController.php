<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    /**
     * Tampilkan halaman chatbot di home.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home'); // Pastikan file home.blade.php Anda ada di folder resources/views
    }

    /**
     * Handle chatbot message and return reply.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleMessage(Request $request)
    {
        $message = $request->input('message'); // Ambil pesan dari pengguna

        try {
            // Kirim permintaan ke API Gemini
            $response = Http::post(env('CHATBOT_API_URL'), [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $message
                            ]
                        ]
                    ]
                ]
            ]);
        
            // Jika respons berhasil
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'reply' => $response->json(), // Pastikan key 'reply' sesuai struktur API Gemini
                ]);
            } else {
                // Jika respons gagal
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maaf, chatbot tidak dapat memproses pesan Anda saat ini.',
                ], $response->status());
            }
        } catch (\Exception $e) {
            // Tangani error
            \Log::error('Chatbot Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.',
            ], 500);
        }
    }
}
