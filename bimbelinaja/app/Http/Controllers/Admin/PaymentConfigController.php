<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentConfig;
use Illuminate\Http\Request;

class PaymentConfigController extends Controller
{
    public function index()
    {
        $config = PaymentConfig::first() ?? new PaymentConfig();
        return view('admin.payment_configs.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'bank_account' => 'required|string',
            'bank_owner' => 'required|string',
            'registration_fee' => 'required|numeric',
        ]);

        PaymentConfig::updateOrCreate(['id' => 1], $request->all());

        return back()->with('success', 'Data Bank & Biaya Berhasil Diperbarui! 💳');
    }
}