<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        date_default_timezone_set('Asia/Jakarta');

        // Gate::define('sekertaris', function(User $user){
        //     return $user->role === 'sekertaris';
        // });

        // Gate::define('bendahara', function(User $user){
        //     return $user->role === 'bendahara';
        // });

        // Gate::define('admin', function(User $user){
        //     return $user->role === 'admin';
        // });
       
        Gate::define('penarikan_tagihan', function(User $user){
            $allowedRoles = ['penagih']; // Tambahkan peran lain yang diizinkan
        
            return in_array($user->role, $allowedRoles);
        });

        Gate::define('laporan_tagihan', function(User $user){
            $allowedRoles = ['penagih']; // Tambahkan peran lain yang diizinkan
        
            return in_array($user->role, $allowedRoles);
        });
        

        Gate::define('keuangan', function(User $user){
            $allowedRoles = ['pengurus']; // Tambahkan peran lain yang diizinkan
        
            return in_array($user->role, $allowedRoles);
        });
       
        
    }
}
