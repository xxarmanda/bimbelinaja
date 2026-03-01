<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| PUBLIC CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentTransactionController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\SubProgramController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\RegistrationStepController;
use App\Http\Controllers\Admin\RegistrationSettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\PaymentConfigController;
use App\Http\Controllers\Admin\OnlineSettingController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| MODELS
|--------------------------------------------------------------------------
*/
use App\Models\Program;
use App\Models\Discount;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Tutor;
use App\Models\Benefit;
use App\Models\RegistrationStep;
use App\Models\Mission;
use App\Models\ServiceArea;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome', [
        'programs'          => Program::all(),
        'discounts'         => Discount::where('is_active', true)->get(),
        'sliders'           => Slider::where('is_active', true)->latest()->get(),
        'tutors'            => Tutor::latest()->get(),
        'registrationSteps'=> RegistrationStep::orderBy('order')->get(),
        'settings'          => Setting::pluck('value','key')->all(),
        'testimonials'     => Testimonial::latest()->get(),
        'serviceAreas'     => ServiceArea::where('is_active', true)->get(),
    ]);
})->name('home');

Route::controller(ProgramController::class)->group(function () {
    Route::get('/program-les', 'index_public')->name('programs.public');
    Route::get('/program-les/{id}', 'show')->name('programs.show');
    Route::get('/katalog/{id}', 'katalog')->name('admin.programs.katalog');
    Route::get('/les-online', 'lesOnline')->name('online.public');
});

Route::get('/tentang-kami', function () {
    return view('about', [
        'programs' => Program::all(),
        'settings' => Setting::pluck('value','key')->all(),
        'missions' => Mission::all()
    ]);
})->name('about.public');

Route::get('/karir', function () {
    return view('career', [
        'programs' => Program::all(),
        'testimonials' => Testimonial::all(),
        'benefits' => Benefit::all(),
        'settings' => Setting::pluck('value','key')->all()
    ]);
})->name('career.public');

Route::get('/hubungi-kami', function () {
    return view('contact', [
        'programs' => Program::all(),
        'settings' => Setting::pluck('value','key')->all()
    ]);
})->name('contact.public');

Route::post('/contact/send', [ContactMessageController::class, 'store'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| TRANSACTION ROUTES
|--------------------------------------------------------------------------
*/

Route::controller(StudentTransactionController::class)->group(function () {
    Route::get('/invoice/{transaction_id}', 'invoice')->name('pembayaran.invoice');
    Route::get('/kalkulator-biaya/{id}', 'kalkulator')->name('kalkulator.biaya');
    Route::get('/checkout/{sub_program_id}', 'checkout')->name('checkout');
    Route::post('/transaction/store', 'store')->name('transaction.store');
    Route::get('/ringkasan-pendaftaran/{transaction_id}', 'summary')->name('transaction.summary');
    Route::get('/pembayaran/instruksi/{transaction_id}', 'instruction')->name('pembayaran.instruksi');
    Route::patch('/pembayaran/upload/{transaction_id}', 'uploadProof')->name('pembayaran.upload');
    Route::get('/pembayaran/terkirim/{transaction_id}', 'pembayaranSelesai')->name('pembayaran.terkirim');
    Route::get('/akses-bimbel/{transaction_id}', 'learningPage')->name('belajar.index');
    Route::get('/invoice/download/{transaction_id}', 'downloadInvoice')->name('invoice.download');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::resource('missions', MissionController::class);
    Route::resource('messages', ContactMessageController::class)->only(['index','destroy']);
    Route::get('/settings/contact', [SettingController::class,'contactIndex'])->name('contact.settings');

    Route::resource('tutors', TutorController::class);
    Route::resource('programs', AdminProgramController::class);
    Route::patch('settings/tutor', [TutorController::class,'updateSettings'])->name('settings.tutor.update');

    Route::get('/payment-configs', [PaymentConfigController::class,'index'])->name('payment-configs.index');
    Route::patch('/payment-configs', [PaymentConfigController::class,'update'])->name('payment-configs.update');

    Route::resource('service-areas', ServiceAreaController::class);
    Route::patch('settings/area', [ServiceAreaController::class, 'updateSettings'])
        ->name('settings.area.update');

    Route::resource('sub-programs', SubProgramController::class);
    Route::resource('online-settings', OnlineSettingController::class)->only(['index','edit','update']);
    Route::resource('discounts', DiscountController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('benefits', BenefitController::class);
    Route::resource('registration-steps', RegistrationStepController::class);

    // TESTIMONIALS
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/update-title', [TestimonialController::class,'updateTitle'])
        ->name('testimonials.updateTitle');

    // PENDAFTARAN SETTINGS
    Route::put('registration-settings', 
        [RegistrationSettingController::class,'update']
    )->name('registration.settings.update');

    // TRANSACTIONS
    Route::get('/registrations', [TransactionController::class,'index'])->name('transactions.index');
    Route::get('/registrations/{id}', [TransactionController::class,'show'])->name('transactions.show');
    Route::patch('/transactions/verify/{id}', [TransactionController::class,'verify'])->name('transaction.verify');
    Route::delete('/registrations/{id}', [TransactionController::class,'destroy'])->name('transactions.destroy');

    Route::get('/settings', [SettingController::class,'index'])->name('settings.index');
    Route::patch('/settings/video', [SettingController::class,'update'])->name('settings.video.update');
    Route::delete('/settings/video',[SettingController::class,'destroy'])->name('settings.video.destroy');

    Route::patch('/admin/settings/update', [BenefitController::class, 'updateSettings'])
    ->name('admin.settings.video.update');
});

Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))->middleware('auth')->name('dashboard');

Route::get('/profile', [ProfileController::class,'edit'])->middleware('auth')->name('profile.edit');

require __DIR__.'/auth.php';