<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * Menghubungkan tag <x-admin-layout> ke file layouts/admin.blade.php
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}