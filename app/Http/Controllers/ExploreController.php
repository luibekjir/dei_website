<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\MenuItem;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::with(['restaurant.category', 'city']);
        $query = $this->applyFilters($request, $query);

        $menus = $query->get();
        $categories = Category::all();

        // Recommendations based on User's origin
        $recommendations = collect();
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->province_id || $user->city_id) {
                $recommendations = MenuItem::with(['restaurant.category', 'city'])
                    ->where(function ($q) use ($user) {
                        $q->where('province_id', $user->province_id)
                          ->orWhere('city_id', $user->city_id);
                    })
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
            }
        }

        // User's primary address for map center
        $userAddress = null;
        if (auth()->check()) {
            $userAddress = auth()->user()->addresses()->where('is_primary', true)->first() 
                ?? auth()->user()->addresses()->first();
        }

        return view('explore', compact('menus', 'categories', 'recommendations', 'userAddress'));
    }

    private function applyFilters(Request $request, $query)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('restaurant', function ($rq) use ($search) {
                      $rq->where('name', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('budget')) {
            $budget = (int) $request->budget;
            if ($budget === 1) $query->where('price', '<=', 30000);
            if ($budget === 2) $query->whereBetween('price', [30001, 50000]);
            if ($budget === 3) $query->whereBetween('price', [50001, 100000]);
            if ($budget === 4) $query->where('price', '>', 100000);
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('category')) {
            $query->whereHas('restaurant', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        if ($request->filled('province')) {
            $query->where('province_id', $request->province);
        }

        if ($request->filled('city')) {
            $query->where('city_id', $request->city);
        }

        if ($request->filled('district')) {
            $query->whereHas('restaurant', function ($q) use ($request) {
                $q->where('district_id', $request->district);
            });
        }

        return $query;
    }

    public function show(Restaurant $restaurant, Request $request)
    {
        $highlightId = $request->query('highlight');
        $restaurant->load(['category', 'menuItems' => function ($query) use ($highlightId) {
            if ($highlightId) {
                $query->orderByRaw('id = ? DESC', [$highlightId]);
            }
        }]);

        $highlightedMenu = $highlightId ? $restaurant->menuItems->firstWhere('id', $highlightId) : null;
        
        return view('restaurant', compact('restaurant', 'highlightId', 'highlightedMenu'));
    }

    public function random(Request $request)
    {
        $query = MenuItem::query();
        $query = $this->applyFilters($request, $query);
        
        $menu = $query->inRandomOrder()->first();
        
        if (!$menu) {
            return redirect()->route('explore')->with('error', 'No menus found matching your filters.');
        }
        
        return redirect()->route('restaurant.show', [$menu->restaurant_id, 'highlight' => $menu->id]);
    }
}