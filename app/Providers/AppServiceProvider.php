<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Rescue;
use App\Models\Adoption;

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
        // Share adoption metrics with the admin layout
        View::composer('layouts.admin', function ($view) {
            // Count pending rescue reports (rescues not yet rescued or in pending status)
            // Do NOT include 'Pending for Adoption' - that should only show in Adoption Management
            $pendingCount = Rescue::whereIn('status', ['Pending', 'not yet rescue'])->count();
            
            // Count pending adoptions (adoption requests waiting for admin confirmation)
            $pendingAdoptionsCount = Adoption::whereNull('adopted_at')->count();
            
            $view->with('pendingCount', $pendingCount);
            $view->with('pendingAdoptionsCount', $pendingAdoptionsCount);
        });
    }
}
