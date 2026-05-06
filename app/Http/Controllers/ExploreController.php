<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with(['restaurant.category']);
        $query = $this->applyFilters($request, $query);

        $menus = $query->get();
        $categories = Category::all();

        return view('explore', compact('menus', 'categories'));
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
            if ($budget === 1) $query->where('price', '<=', 15);
            if ($budget === 2) $query->whereBetween('price', [16, 30]);
            if ($budget === 3) $query->whereBetween('price', [31, 60]);
            if ($budget === 4) $query->where('price', '>', 60);
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('category')) {
            $query->whereHas('restaurant', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        return $query;
    }

    public function show(Restaurant $restaurant, Request $request)
    {
        $highlightId = $request->query('highlight');
        $restaurant->load(['category', 'menus' => function ($query) use ($highlightId) {
            if ($highlightId) {
                $query->orderByRaw('id = ? DESC', [$highlightId]);
            }
        }]);

        $highlightedMenu = $highlightId ? $restaurant->menus->firstWhere('id', $highlightId) : null;
        
        return view('restaurant', compact('restaurant', 'highlightId', 'highlightedMenu'));
    }

    public function random(Request $request)
    {
        $query = Menu::query();
        $query = $this->applyFilters($request, $query);
        
        $menu = $query->inRandomOrder()->first();
        
        if (!$menu) {
            return redirect()->route('explore')->with('error', 'No menus found matching your filters.');
        }
        
        return redirect()->route('restaurant.show', [$menu->restaurant_id, 'highlight' => $menu->id]);
    }
}