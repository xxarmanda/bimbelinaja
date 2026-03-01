<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

// 1. PUBLIC CONTROLLERS
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController; // Controller untuk Siswa
use App\Http\Controllers\StudentTransactionController;

// 2. ADMIN CONTROLLERS (Diberikan Alias 'Admin' agar tidak tabrakan)
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\SubProgramController;
use App\Http\Controllers\Admin\SettingController; 
use App\Http\Controllers\Admin\SliderController; 
use App\Http\Controllers\Admin\TestimonialController; 
use App\Http\Controllers\Admin\StudentTestimonialController; 
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\RegistrationStepController; 
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\MediaCoverageController; 
use App\Http\Controllers\Admin\PaymentConfigController; 
use App\Http\Controllers\Admin\OnlineSettingController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController; // ALIAS PENTING ✨

// 3. MODELS
use App\Models\Program;
use App\Models\Discount;
use App\Models\Setting; 
use App\Models\Slider; 
use App\Models\Testimonial; 
use App\Models\StudentTestimonial; 
use App\Models\Tutor;
use App\Models\Benefit;
use App\Models\RegistrationStep; 
use App\Models\Mission;
use App\Models\ServiceArea;
use App\Models\MediaCoverage; 

/*
|--------------------------------------------------------------------------
| Web Routes - BimbelinAja Signature System
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. RUTE PUBLIK & INFORMASI (TANPA LOGIN)
// =========================================================================

Route::get('/', function () {
    $programs = Program::all();
    $discounts = Discount::where('is_active', true)->get();
    $sliders = Slider::where('is_active', true)->latest()->get();
    $tutors = Tutor::latest()->get(); 
    $registrationSteps = RegistrationStep::orderBy('order')->get();
    $settings = Setting::pluck('value', 'key')->all();
    $testimonials = StudentTestimonial::latest()->get();
    $serviceAreas = ServiceArea::where('is_active', true)->get();
    $mediaCoverages = MediaCoverage::where('is_active', true)->get();

    return view('welcome', compact(
        'programs', 'discounts', 'sliders', 'tutors', 'settings', 
        'registrationSteps', 'testimonials', 'serviceAreas', 'mediaCoverages' 
    ));
})->name('home');

// KELOMPOK RUTE PROGRAM (Sudah bersih dari duplikasi)
Route::controller(ProgramController::class)->group(function () {
    Route::get('/program-les', 'index_public')->name('programs.public');
    Route::get('/program-les/{id}', 'show')->name('programs.show');
    Route::get('/katalog/{id}', 'katalog')->name('admin.programs.katalog');
    Route::get('/les-online', 'lesOnline')->name('online.public'); 
});

// Halaman Informasi Statis
Route::get('/tentang-kami', function () {
    $programs = Program::all();
    $settings = Setting::pluck('value', 'key')->all();
    $missions = Mission::all(); 
    return view('about', compact('programs', 'settings', 'missions'));
})->name('about.public');

Route::get('/karir', function () {
    $programs = Program::all();
    $testimonials = Testimonial::all(); 
    $benefits = Benefit::all(); 
    $settings = Setting::pluck('value', 'key')->all(); 
    return view('career', compact('programs', 'testimonials', 'benefits', 'settings'));
})->name('career.public');

Route::get('/hubungi-kami', function () {
    $programs = Program::all();
    $settings = Setting::pluck('value', 'key')->all();
    return view('contact', compact('programs', 'settings'));
})->name('contact.public');

Route::post('/contact/send', [ContactMessageController::class, 'store'])->name('contact.send');


// =========================================================================
// 2. JALUR PENDAFTARAN SISWA (TRANSAKSI)
// =========================================================================

Route::controller(StudentTransactionController::class)->group(function () {
    Route::get('/invoice/{transaction_id}', 'invoice')->name('pembayaran.invoice');
    Route::get('/kalkulator-biaya/{sub_program_id}', 'kalkulator')->name('kalkulator.biaya');
    Route::get('/checkout/{sub_program_id}', 'checkout')->name('checkout');
    Route::post('/transaction/store', 'store')->name('transaction.store');
    Route::get('/ringkasan-pendaftaran/{transaction_id}', 'summary')->name('transaction.summary');
    Route::get('/pembayaran/instruksi/{transaction_id}', 'instruction')->name('pembayaran.instruksi');
    Route::patch('/pembayaran/upload/{transaction_id}', 'uploadProof')->name('pembayaran.upload');
    Route::get('/pembayaran/terkirim/{transaction_id}', 'pembayaranSelesai')->name('pembayaran.terkirim');
    Route::get('/akses-bimbel/{transaction_id}', 'learningPage')->name('belajar.index');
    Route::get('/invoice/download/{transaction_id}', 'downloadInvoice')->name('invoice.download');
});


// =========================================================================
// 3. RUTE DASHBOARD & ADMIN (WAJIB LOGIN)
// =========================================================================

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::middleware([AdminMiddleware::class])
        ->prefix('admin')
        ->name('admin.') 
        ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::resource('missions', MissionController::class);
        Route::resource('messages', ContactMessageController::class)->only(['index', 'destroy']);
        Route::get('/settings/contact', [SettingController::class, 'contactIndex'])->name('contact.settings');
        
        // MANAJEMEN MASTER DATA
        Route::resource('tutors', TutorController::class);
        Route::resource('programs', AdminProgramController::class); // Pakai Alias Admin ✨

        Route::get('/payment-configs', [PaymentConfigController::class, 'index'])->name('payment-configs.index');
        Route::patch('/payment-configs', [PaymentConfigController::class, 'update'])->name('payment-configs.update');
        
        // CRUD Mata Pelajaran
        Route::resource('sub-programs', SubProgramController::class);
        Route::delete('/sub-programs/item/{id}', [SubProgramController::class, 'destroyItem'])->name('sub-programs.destroyItem');
        Route::delete('/sub-programs/benefit/{id}', [SubProgramController::class, 'destroyBenefit'])->name('sub-programs.destroyBenefit');

        // CRUD Area Layanan Ciayumajakuning
        Route::resource('service-areas', ServiceAreaController::class);

        // CRUD MEDIA COVERAGE
        Route::resource('media-coverages', MediaCoverageController::class);

        // CRUD KONTEN LES ONLINE
        Route::resource('online-settings', OnlineSettingController::class)->only(['index', 'edit', 'update']);

        Route::resource('discounts', DiscountController::class);
        Route::resource('sliders', SliderController::class);
        
        Route::resource('testimonials', TestimonialController::class); 
        Route::resource('student-testimonials', StudentTestimonialController::class); 

        Route::resource('benefits', BenefitController::class);
        Route::resource('registration-steps', RegistrationStepController::class);

        Route::get('/registrations', [TransactionController::class, 'index'])->name('transactions.index');
        // Cari bagian ini di web.php
        Route::get('/registrations', [TransactionController::class, 'index'])->name('transactions.index');
        // TAMBAHKAN BARIS INI TEPAT DI BAWAHNYA ✨
        Route::get('/registrations/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::patch('/transactions/verify/{id}', [TransactionController::class, 'verify'])->name('transaction.verify');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::patch('/settings/video', [SettingController::class, 'update'])->name('settings.video.update');
        Route::delete('/settings/video', [SettingController::class, 'destroyVideo'])->name('settings.video.destroy');

        // Menghapus rute duplikat payment-configs yang salah penamaan
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';