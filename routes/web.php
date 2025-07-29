<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminEventsController;
use App\Http\Controllers\AdminMedpartsController;
use App\Http\Controllers\AdminPenontonController;
use App\Http\Controllers\AdminPresenceController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminSponsorshipsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminTicketingController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
//Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth']);
Route::prefix('/')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::post('contactMedpart', [HomeController::class, 'sendMedpart'])->name('contactMedpart');
        Route::post('contactSponsor', [HomeController::class, 'sendSponsorship'])->name('contactSponsor');
        Route::get("listticket", [TicketController::class, 'listticket'])->name('listticket');

        Route::get("verifikasiPembayaran/{id}", [TicketController::class, 'verifikasi'])->name('verifikasiPembayaran');

        Route::get('verifikasiLogin', function () {
            return view('verifikasi_login');
        })->name('verifikasiLogin');
        Route::get("getPanitia/{id}", [PanitiaController::class, "getData"])->name("getPanitia");
        Route::get("getVoucher/{id}", [VoucherController::class, "getData"])->name("getVoucher");
        Route::patch("uploadPembayaran/{id}", [TicketController::class, "formPembayaran"])->name("uploadPembayaran");
        Route::post('submitBundleEmail/{id}', [TicketController::class, "bundleEmail"])->name("bundleEmail");
        Route::post('/buy-ticket', [OrderController::class, 'buyTicket'])->name('buy.ticket');
        Route::post('/payment-notification', [OrderController::class, 'paymentNotification']);
        Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/payment/pending', [OrderController::class, 'paymentPending'])->name('payment.pending');
        Route::get('/payment/error', [OrderController::class, 'paymentError'])->name('payment.error');
        Route::get('/payment', function (Request $request) {
            return view('payment', [
                'snapToken' => $request->snap_token
            ]);
        })->name('payment.page');
    });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'loginpage')->name('login');
    Route::get('/register', 'registerpage')->name('register');
    Route::post('/login', 'loginmethod');
    Route::post('/register', 'registermethod')->name('registermethod');
    Route::post('/logout', 'logoutmethod')->name('logout');

    // Lupa Kata Sandi (Reset Password)
    Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        // dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::controller(AdminPenontonController::class)->group(function () {
            Route::get('/Penonton', 'index')->name('index.penonton');
            Route::get('/Penonton/Ticket/{id}', 'getticketpenonton')->name('tiket.penonton');
            Route::patch('/Penonton/{id}', 'confirm')->name('confirm.tiket.penonton');
            Route::get("/Penonton/OfflineTransaction", "sendOfflineTransactionEmail");
            Route::get("/Penonton/BelumBayar", "sendBelumBayarEmail");
        });
        Route::controller(AdminTicketingController::class)->group(function () {
            Route::get('/OfflineTicketing', 'index')->name('index.ticketing');
            Route::post("/storeTicketing", "store")->name("store.ticketing");
            Route::post("/resendMail/{id}", "resendMail")->name("resendMail.ticketing");
        });
        Route::controller(LaporanController::class)->group(function () {
            Route::get('/Laporan', 'index')->name('Laporan.index');
            Route::get('/Laporan/export', 'export')->name('admin.laporan.export');
        });

        Route::get('Postingan', [PostinganController::class, 'index'])->name('Postingan.index');

        // presence
        Route::get('presence', [AdminPresenceController::class, 'index'])->name('admin.presence');
        Route::get('userdata', [AdminPresenceController::class, 'getuserdata'])->name('admin.presence.userdata');
        Route::post('presence', [AdminPresenceController::class, 'presence'])->name('admin.presence.presenced');

        // settings
        Route::get('settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
        Route::put('settings/{setting}', [AdminSettingsController::class, 'update'])->name('admin.settings.update');

        // sponsors
        Route::get('sponsorship', [AdminSponsorshipsController::class, 'index'])->name('admin.sponsorship');
        Route::post('sponsorship/store', [AdminSponsorshipsController::class, 'store'])->name('admin.sponsorship.store');
        Route::patch('sponsorship/update/{id}', [AdminSponsorshipsController::class, 'update'])->name('admin.sponsorship.update');
        Route::get('sponsorship/edit/{id}', [AdminSponsorshipsController::class, 'edit'])->name('admin.sponsorship.edit');
        Route::delete('sponsorship/destroy/{id}', [AdminSponsorshipsController::class, 'destroy'])->name('admin.sponsorship.destroy');

        // events
        Route::get('event', [AdminEventsController::class, 'index'])->name('admin.event');
        Route::post('event/store', [AdminEventsController::class, 'store'])->name('admin.event.store');
        Route::get('event/destroy/{id}', [AdminEventsController::class, 'destroy'])->name('admin.event.destroy');

        // medpart
        Route::get('medpart', [AdminMedpartsController::class, 'index'])->name('admin.medpart');
        Route::post('medpart/store', [AdminMedpartsController::class, 'store'])->name('admin.medpart.store');
        Route::patch('medpart/update/{id}', [AdminMedpartsController::class, 'update'])->name('admin.medpart.update');
        Route::get('medpart/edit/{id}', [AdminMedpartsController::class, 'edit'])->name('admin.medpart.edit');
        Route::get('medpart/destroy/{id}', [AdminMedpartsController::class, 'destroy'])->name('admin.medpart.destroy');

        Route::resource('Ticket', TicketController::class);
        Route::resource('Voucher', VoucherController::class);
    });