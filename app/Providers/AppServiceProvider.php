<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated; // <--- Import Penting
use Illuminate\Support\Facades\Auth; // <--- Import Penting

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
        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();

            if ($user->isAdmin()) {
                return route('dashboard');
            }
            
            // Tambahkan Cek Dosen
            if ($user->isDosen()) {
                return route('dosen.dashboard');
            }

            return route('student.dashboard');
        });
    }
}