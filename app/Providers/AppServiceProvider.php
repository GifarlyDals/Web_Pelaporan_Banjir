<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Laporan;
use App\Models\Komentar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $alerts = Laporan::latest()
                ->take(3)
                ->get();

            $jumlahAlerts = Laporan::where(
                'status',
                'verifikasi'
            )->count();

            // ======================
            // ADMIN
            // ======================

            if (Auth::check() && Auth::user()->role == 'admin') {

                $messages = Komentar::with(['user', 'laporan'])
                    ->where('user_id', '!=', Auth::id())
                    ->latest()
                    ->take(3)
                    ->get();
            }

            // ======================
            // USER
            // ======================

            else {

                $messages = Komentar::with(['user', 'laporan'])

                    ->whereHas('laporan', function ($query) {

                        $query->where('user_id', Auth::id());
                    })

                    ->where('user_id', '!=', Auth::id())

                    ->latest()
                    ->take(3)
                    ->get();
            }

            $jumlahPesan = $messages->count();

            $view->with([
                'alerts' => $alerts,
                'jumlahAlerts' => $jumlahAlerts,
                'messages' => $messages,
                'jumlahPesan' => $jumlahPesan,
            ]);
        });
    }
}
