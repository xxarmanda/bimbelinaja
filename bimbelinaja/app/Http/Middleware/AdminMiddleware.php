<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB ADA: Mengimpor Facade Auth
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Gunakan '==' agar lebih fleksibel (teks atau angka tetap terbaca)
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // JANGAN arahkan ke '/dashboard' karena akan menyebabkan putaran (loop)
        // Arahkan ke beranda utama jika bukan admin
        return redirect('/')->with('error', 'Akses Terbatas! Hanya untuk Admin.');
    }
}