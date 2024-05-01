<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminInvitationController;
use App\Http\Controllers\Admin\AdminWeddingController;
use App\Http\Controllers\Admin\AdminPreweddingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicInvitationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// public
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/invitations/{invitation}', [PublicInvitationController::class, 'show'])->name('public.invitations.show');

// Authentication Routes...
// Admin routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard route
    Route::get('/', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class,'users'])->name('users');
    
    // Invitations
    Route::get('/invitations', [AdminInvitationController::class, 'index'])->name('invitations.index');
    Route::get('/admin/invitations/{invitation}', [AdminInvitationController::class, 'show'])->name('invitations.show');
    Route::get('/invitations/create', [AdminInvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [AdminInvitationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{id}/edit', [AdminInvitationController::class, 'edit'])->name('invitations.edit');
    Route::put('/invitations/{id}', [AdminInvitationController::class, 'update'])->name('invitations.update');
    Route::delete('/invitations/{id}', [AdminInvitationController::class, 'destroy'])->name('invitations.destroy');
    Route::get('/weddings/create', [AdminWeddingController::class, 'create'])->name('weddings.create');
    Route::post('/weddings', [AdminWeddingController::class, 'store'])->name('weddings.store');
    Route::get('/prewedding/create/{invitation}', [AdminPreweddingController::class, 'create'])->name('prewedding.create');
    Route::post('/prewedding/store/{invitation}', [AdminPreweddingController::class, 'store'])->name('prewedding.store');

    // Other admin routes...
});

Auth::routes();

