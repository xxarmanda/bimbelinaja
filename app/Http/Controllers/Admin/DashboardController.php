<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\ContactMessage;
use App\Models\Tutor;
use App\Models\Program;
use App\Models\SubProgram;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Benefit;
use App\Models\RegistrationStep;
use App\Models\ServiceArea;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'transactions' => Transaction::count(),
                'messages' => ContactMessage::count(),
                'tutors' => Tutor::count(),
                'programs' => Program::count(),
                'subprograms' => SubProgram::count(),
                'sliders' => Slider::count(),
                'testimonials' => Testimonial::count(),
                'benefits' => Benefit::count(),
                'registration_steps' => RegistrationStep::count(),
                'service_areas' => ServiceArea::count(),
            ],

            'recentTransactions' => Transaction::latest()->limit(5)->get(),
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
        ]);
    }
}