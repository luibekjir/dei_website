<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Review;
use App\Models\Order;
use App\Models\User;

class RecommendationService
{
    /**
     * Get recommendations for a user using collaborative filtering and fallback content-based filtering.
     *
     * @param User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecommendations(User $user, $limit = 4)
    {
        $collaborativeRecommendations = $this->collaborativeFiltering($user, $limit);

        if ($collaborativeRecommendations->count() >= $limit) {
            return $collaborativeRecommendations->take($limit);
        }

        $fallbackLimit = $limit - $collaborativeRecommendations->count();
        $fallbackRecommendations = $this->fallbackRecommendations($user, $fallbackLimit, $collaborativeRecommendations->pluck('id')->toArray());

        return $collaborativeRecommendations->merge($fallbackRecommendations);
    }

    /**
     * Basic User-Based Collaborative Filtering.
     * Finds users with similar ratings/orders and recommends items they liked.
     */
    private function collaborativeFiltering(User $user, $limit)
    {
        // Get restaurants the user has reviewed positively (rating >= 4)
        $userLikedRestaurants = Review::where('user_id', $user->id)
            ->where('rating', '>=', 4)
            ->pluck('restaurant_id')
            ->toArray();

        if (empty($userLikedRestaurants)) {
            return collect();
        }

        // Find other users who also liked these restaurants
        $similarUsers = Review::whereIn('restaurant_id', $userLikedRestaurants)
            ->where('rating', '>=', 4)
            ->where('user_id', '!=', $user->id)
            ->pluck('user_id')
            ->toArray();

        if (empty($similarUsers)) {
            return collect();
        }

        // Get restaurants liked by similar users that the current user hasn't tried
        $recommendedRestaurants = Review::whereIn('user_id', $similarUsers)
            ->where('rating', '>=', 4)
            ->whereNotIn('restaurant_id', $userLikedRestaurants)
            ->pluck('restaurant_id')
            ->toArray();

        if (empty($recommendedRestaurants)) {
            return collect();
        }

        // Recommend top menu items from these restaurants
        return MenuItem::with(['restaurant.category', 'city'])
            ->whereIn('restaurant_id', $recommendedRestaurants)
            ->where('available', true)
            ->orderBy('rating', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Fallback based on user location, budget (from past orders if any), or just highly rated items in their city.
     */
    private function fallbackRecommendations(User $user, $limit, array $excludeIds)
    {
        $query = MenuItem::with(['restaurant.category', 'city'])
            ->whereNotIn('id', $excludeIds)
            ->where('available', true);

        if ($user->province_id || $user->city_id) {
            $query->where(function ($q) use ($user) {
                if ($user->province_id) $q->orWhere('province_id', $user->province_id);
                if ($user->city_id) $q->orWhere('city_id', $user->city_id);
            });
        }

        return $query->inRandomOrder()->take($limit)->get();
    }
}
