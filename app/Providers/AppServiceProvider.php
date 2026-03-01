<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\URL; // IMPORT BARU: Untuk memperbaiki masalah ngrok
use App\Models\ContactMessage; 

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
        /**
         * FIX NGROK: Paksa Laravel menggunakan protokol HTTPS.
         * Ini memperbaiki error 'MethodNotAllowedHttpException' (POST jadi GET) 
         * saat diakses melalui ngrok di handphone.
         */
        if (str_contains(request()->header('Host'), 'ngrok-free.dev') || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        /** * Membagikan data jumlah pesan yang belum dibaca ke layout admin secara global.
         * Pengecekan Schema::hasTable sangat penting agar aplikasi tidak error saat
         * database baru dibuat atau saat proses migrasi sedang berjalan.
         */
        View::composer('layouts.admin', function ($view) {
            if (Schema::hasTable('contact_messages')) {
                $unreadCount = ContactMessage::where('is_read', false)->count();
                $view->with('unreadCount', $unreadCount);
            }
        });
    }
}