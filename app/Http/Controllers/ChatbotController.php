<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = strtolower($request->message);
        
        $response = $this->parseIntent($message);
        
        return response()->json($response);
    }

    private function parseIntent($message)
    {
        // 1. Ambil data menu yang tersedia untuk konteks
        $availableMenus = MenuItem::with(['restaurant.category'])->where('available', true)->get()->map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'description' => $menu->description,
                'halal' => $menu->is_halal ? 'yes' : 'no',
                'spice_level' => $menu->spice_level,
                'restaurant' => $menu->restaurant->name ?? '',
                'category' => $menu->restaurant->category->name ?? 'General',
                'rating' => $menu->rating
            ];
        });

        $systemInstruction = "You are a friendly, helpful Culinary AI Assistant for Culinary Atelier. You MUST respond in valid JSON format. Provide two keys: 'message' (string, your friendly response in Indonesian) and 'recommended_ids' (array of integers, maximum 3 menu IDs that match the user's request). If no menu matches or the request is not related to food, keep the array empty. Here is the list of available menus: \n" . json_encode($availableMenus);

        $apiKey = config('services.gemini.api_key');
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:generateContent?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemInstruction . "\n\nUser Message: " . $message]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $textResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                
                // Parse JSON
                $geminiResult = json_decode($textResponse, true);
                
                $responseMessage = $geminiResult['message'] ?? "Maaf, aku tidak menemukan rekomendasi yang pas.";
                $recommendedIds = $geminiResult['recommended_ids'] ?? [];

                // Fetch real menus
                $menus = collect();
                if (!empty($recommendedIds)) {
                    $menus = MenuItem::with(['restaurant'])->whereIn('id', $recommendedIds)->get()->map(function ($menu) {
                        return [
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'price' => 'Rp ' . number_format($menu->price, 0, ',', '.'),
                            'rating' => $menu->rating,
                            'restaurant_name' => $menu->restaurant->name ?? '',
                            'url' => route('restaurant.show', [$menu->restaurant_id, 'highlight' => $menu->id])
                        ];
                    });
                }

                return [
                    'message' => $responseMessage,
                    'menus' => $menus
                ];

            } else {
                $errorBody = $response->json();
                $errorMessage = $errorBody['error']['message'] ?? 'Error tidak diketahui dari API.';
                $statusCode = $response->status();
                
                \Illuminate\Support\Facades\Log::error('Gemini API Error (' . $statusCode . '): ' . $response->body());
                
                $friendlyMessage = "Maaf, terjadi kesalahan dari server AI (Error $statusCode): $errorMessage";
                
                if ($statusCode == 429) {
                    $friendlyMessage = "Waduh, aku lagi pusing kebanyakan mikir nih (Error 429: Too Many Requests). Tunggu sekitar 1 menit lagi ya sebelum mengirim pesan baru!";
                } elseif ($statusCode == 404) {
                    $friendlyMessage = "Waduh, model AI yang diminta tidak ditemukan (Error 404). Pastikan konfigurasi API Key dan nama model di kode sudah benar.";
                }

                return [
                    'message' => $friendlyMessage,
                    'menus' => []
                ];
            }
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gemini Request Exception: ' . $e->getMessage());
            return [
                'message' => 'Maaf, terjadi kesalahan sistem: ' . $e->getMessage(),
                'menus' => []
            ];
        }
    }
}
