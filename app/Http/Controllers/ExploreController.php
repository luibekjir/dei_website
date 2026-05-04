<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::with([
            'category',
            'menus'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Budget Filter
        |--------------------------------------------------------------------------
        | Berdasarkan harga menu
        */

        if ($request->filled('budget')) {
            $budget = (int) $request->budget;

            $query->whereHas('menus', function ($q) use ($budget) {
                if ($budget === 1) {
                    $q->where('price', '<=', 15);
                }

                if ($budget === 2) {
                    $q->whereBetween('price', [16, 30]);
                }

                if ($budget === 3) {
                    $q->whereBetween('price', [31, 60]);
                }

                if ($budget === 4) {
                    $q->where('price', '>', 60);
                }
            });
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
            $query->where('category_id', $request->category);
        }

        /*
        |--------------------------------------------------------------------------
        | Final Data
        |--------------------------------------------------------------------------
        */

        $restaurants = $query->get();
        $categories = Category::all();

        return view('explore', compact(
            'restaurants',
            'categories'
        ));
    }
}