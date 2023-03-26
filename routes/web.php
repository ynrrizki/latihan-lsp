<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\OperatorController;
use App\Http\Controllers\Admin\SppController;
use App\Http\Controllers\Admin\StdClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::get('/admin/table', function () {
    return view('pages.admin.class.index');
});

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
    Route::get('/registration', [AuthController::class, 'create'])->name('regis');
    Route::post('/registration', [AuthController::class, 'registration'])->name('auth.regis');
});

Route::get('/logout', [AuthController::class, 'destroy'])->name('auth.logout');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        // Route::resource('user', UserController::class);
        Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin');
        // Route::get('/admin/payment/{year}/{month}', [DashboardAdminController::class, 'index'])->name('admin');
        Route::resource('operator', OperatorController::class);
        Route::resource('student', StudentController::class);
        Route::resource('class', StdClassController::class);
        Route::resource('spp', SppController::class);
    });

    Route::group(['middleware' => 'isOperator'], function () {
        // Route::get('/entry-payment/{id}', [PaymentController::class, 'edit'])->name('payment.store');
        Route::get('/history-payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::post('/entry-payment', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/entry-payment/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::put('/entry-payment/{id}', [PaymentController::class, 'update'])->name('payment.update');
        Route::delete('/entry-payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');
    });

    Route::get('/history-payment/student', [PaymentController::class, 'show'])->name('payment.show');
});
