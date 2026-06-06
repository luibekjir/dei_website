<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Restaurant;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Curated Recommendations: Makanan perbandingan review tertinggi (rating) dan harga terendah
        $curatedMenus = MenuItem::with(['restaurant.category'])
            ->where('rating', '>', 0)
            ->where('price', '>', 0)
            ->orderByRaw('(rating / price) DESC')
            ->take(3)
            ->get();

        // 2. Trending Tastes: Makanan paling banyak di-review (berdasarkan review_count restoran)
        $trendingRestaurants = Restaurant::withCount('reviews')
            ->has('reviews', '>', 0)
            ->orderBy('reviews_count', 'desc')
            ->take(4)
            ->get();
        
        $trendingMenus = collect();
        foreach ($trendingRestaurants as $restaurant) {
            $topMenu = $restaurant->menuItems()->orderBy('rating', 'desc')->first();
            if ($topMenu) {
                $topMenu->setRelation('restaurant', $restaurant);
                $trendingMenus->push($topMenu);
            }
        }
        
        // Fallback jika tidak cukup trending menus
        if ($trendingMenus->count() < 4) {
            $fallbackMenus = MenuItem::with(['restaurant'])
                ->orderBy('rating', 'desc')
                ->whereNotIn('id', $trendingMenus->pluck('id')->toArray())
                ->take(4 - $trendingMenus->count())
                ->get();
            $trendingMenus = $trendingMenus->merge($fallbackMenus);
        }

        // 3. Hidden Gems: Restoran dengan review dikit tapi rating tinggi
        $hiddenGems = Restaurant::withCount('reviews')
            ->has('reviews', '<=', 5)
            ->where('rating', '>=', 4.0) // Atau rata-rata tinggi
            ->orderBy('rating', 'desc')
            ->take(4)
            ->get();

        // Fallback jika tidak cukup hidden gems
        if ($hiddenGems->count() < 4) {
            $fallbackGems = Restaurant::withCount('reviews')
                ->orderBy('rating', 'desc')
                ->whereNotIn('id', $hiddenGems->pluck('id')->toArray())
                ->take(4 - $hiddenGems->count())
                ->get();
            $hiddenGems = $hiddenGems->merge($fallbackGems);
        }

        return view('layout', compact('curatedMenus', 'trendingMenus', 'hiddenGems'));
    }
}
