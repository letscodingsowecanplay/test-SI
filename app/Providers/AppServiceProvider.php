<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        Paginator::useBootstrapFive();

        // Cek user login dan role siswa
        View::composer([
            'admin.includes.sidebar',
            'admin.index', // tambahkan view lain jika perlu, bisa array
            // Tambah view lain yang ingin dapat $statusLulus
        ], function ($view) {
            $statusLulus = [];
            if (Auth::check()) {
                $userId = Auth::id();
                $kuisIds = ['ayo-berlatih-2', 'ayo-berlatih-3'];
                $rows = DB::table('nilai')
                    ->where('user_id', $userId)
                    ->whereIn('kuis_id', $kuisIds)
                    ->pluck('status', 'kuis_id')
                    ->toArray();

                foreach ($kuisIds as $id) {
                    $statusLulus[$id] = $rows[$id] ?? null;
                }
            }
            $view->with('statusLulus', $statusLulus);
        });
    }
}
