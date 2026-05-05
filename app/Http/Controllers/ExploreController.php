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
        $query = Menu::with([
            'restaurant.category',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search Filter
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Budget Filter
        |--------------------------------------------------------------------------
        | Berdasarkan harga menu
        */

        if ($request->filled('budget')) {
            $budget = (int) $request->budget;

            if ($budget === 1) {
                $query->where('price', '<=', 15);
            }

            if ($budget === 2) {
                $query->whereBetween('price', [16, 30]);
            }

            if ($budget === 3) {
                $query->whereBetween('price', [31, 60]);
            }

            if ($budget === 4) {
                $query->where('price', '>', 60);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Rating Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {
            $query->whereHas('restaurant', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Final Data
        |--------------------------------------------------------------------------
        */

        $menus = $query->get();
        $categories = Category::all();

        return view('explore', compact(
            'menus',
            'categories'
        ));
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load(['category', 'menus']);
        
        return view('restaurant', compact('restaurant'));
    }
}