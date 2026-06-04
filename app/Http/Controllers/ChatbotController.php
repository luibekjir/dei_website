<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

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
        $query = MenuItem::with(['restaurant.category', 'city'])->where('available', true);
        $intentFound = false;
        $responseMessage = "";

        // Budget intent
        if (preg_match('/(murah|di bawah|under)\s*(\d+)\s*(ribu|k)?/i', $message, $matches)) {
            $intentFound = true;
            $budget = (int) $matches[2];
            if (isset($matches[3]) && in_array(strtolower($matches[3]), ['ribu', 'k'])) {
                $budget *= 1000;
            } else if ($budget < 1000) {
                // assume thousands if they say "di bawah 20"
                $budget *= 1000;
            }
            $query->where('price', '<=', $budget);
            $responseMessage .= "Ini beberapa pilihan makanan dengan harga di bawah Rp " . number_format($budget, 0, ',', '.') . ". ";
        }

        // Category / Taste intent
        if (strpos($message, 'pedas') !== false) {
            $intentFound = true;
            $query->where('spice_level', '>', 2);
            $responseMessage .= "Berikut rekomendasi makanan pedas untukmu. ";
        }

        if (strpos($message, 'halal') !== false) {
            $intentFound = true;
            $query->where('is_halal', true);
            $responseMessage .= "Tentu, ini beberapa pilihan makanan halal. ";
        }
        
        if (strpos($message, 'jepang') !== false || strpos($message, 'japanese') !== false) {
            $intentFound = true;
            $query->whereHas('restaurant.category', function ($q) {
                $q->where('name', 'like', '%Japanese%');
            });
            $responseMessage .= "Ini rekomendasi makanan Jepang yang tersedia. ";
        }
        
        // Specific Food intent
        if (preg_match('/(rendang|sushi|pasta|ayam|pizza|rawon|pempek)/i', $message, $matches)) {
            $intentFound = true;
            $food = $matches[1];
            $query->where(function($q) use ($food) {
                $q->where('name', 'like', "%{$food}%")
                  ->orWhere('description', 'like', "%{$food}%");
            });
            $responseMessage .= "Aku menemukan beberapa menu terkait '$food'. ";
        }

        if (!$intentFound) {
            // Default generic fallback
            $responseMessage = "Aku belum begitu paham. Tapi ini beberapa menu populer yang mungkin kamu suka!";
            $query->orderBy('rating', 'desc');
        } else {
            $query->inRandomOrder();
        }

        $menus = $query->take(3)->get()->map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => 'Rp ' . number_format($menu->price, 0, ',', '.'),
                'rating' => $menu->rating,
                'restaurant_name' => $menu->restaurant->name,
                'url' => route('restaurant.show', [$menu->restaurant_id, 'highlight' => $menu->id])
            ];
        });

        if ($menus->isEmpty()) {
            return [
                'message' => "Maaf, aku tidak menemukan makanan yang sesuai dengan kriteria tersebut. Coba cari dengan kata kunci lain ya!",
                'menus' => []
            ];
        }

        return [
            'message' => $responseMessage,
            'menus' => $menus
        ];
    }
}
