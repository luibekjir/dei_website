<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;
use App\Livewire\RestaurantDeliveryConfig;
use App\Livewire\RestaurantMenuManagement;
use App\Livewire\RestaurantOrderManagement;
use App\Livewire\RestaurantStats;
use App\Livewire\RegionFilter;
use App\Livewire\DeliveryRuleManagement;
use App\Livewire\RestaurantShow;
use App\Livewire\ChatComponent;
use App\Livewire\ReviewComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->setLocale('id');
        $this->configureDefaults();

        \Illuminate\Support\Facades\Blade::directive('currency', function ($expression) {
            return "<?php echo 'Rp ' . number_format($expression, 0, ',', '.'); ?>";
        });

        Livewire::component('restaurant-delivery-config', RestaurantDeliveryConfig::class);
        Livewire::component('restaurant-menu-management', RestaurantMenuManagement::class);
        Livewire::component('restaurant-order-management', RestaurantOrderManagement::class);
        Livewire::component('restaurant-stats', RestaurantStats::class);
        Livewire::component('region-filter', RegionFilter::class);
        Livewire::component('delivery-rule-management', DeliveryRuleManagement::class);
        Livewire::component('restaurant-show', RestaurantShow::class);
        Livewire::component('chat-component', ChatComponent::class);
        Livewire::component('review-component', ReviewComponent::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
