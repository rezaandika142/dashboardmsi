<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function generateResponse(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $apiKey = env('GENERATIVE_API_KEY');
        $apiUrl = env('GENERATIVE_API_URL');

        try {
            $response = Http::post($apiUrl . '?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $request->message]
                        ]
                    ]
                ],
            ]);

            $responseData = $response->json();
            $botReply = $responseData['candidates'][0]['output'] ?? 'Maaf, saya tidak memahami permintaan Anda.';

            return response()->json(['reply' => $botReply]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat memproses permintaan.',
            ], 500);
        }
    }
}
