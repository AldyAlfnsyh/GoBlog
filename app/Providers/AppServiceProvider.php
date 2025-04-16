<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    // public const HOME = '/';
    public function register(): void
    {
        // Filament::registerPanels([
        //     Panel::make()
        //         ->id('admin')
        //         ->path('admin')
        //         ->login()
        //         ->authGuard('web')
        //         ->auth(function (User $user) {
        //             return Gate::allows('access_dashboard_user', $user);
        //         })
        //         ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
        //         ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
        //         ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        //         ->pages([
        //             Dashboard::class,
        //         ]),
        // ]);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        Gate::define('access_post', function(User $user,Post $post){
            return $post->author_id === $user->id;
        });

        Gate::define('access_dashboard_user', function(User $user){
            return $user->is_admin === false;
        });
    }
}
