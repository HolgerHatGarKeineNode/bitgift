<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/webhook', function () {
    return response('OK');
})->name('webhook');

Route::get('/dashboard', \App\Http\Livewire\Dashboard\Dashboard::class)
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

Route::get('/redeem/{withdrawLink:lnbits_id}', \App\Http\Livewire\Redeem\LandingPage::class)
     ->middleware(['signed'])
     ->name('redeem');

Route::middleware('auth')
     ->group(function () {
         Route::get('/profile', [ProfileController::class, 'edit'])
              ->name('profile.edit');
         Route::patch('/profile', [ProfileController::class, 'update'])
              ->name('profile.update');
         Route::delete('/profile', [ProfileController::class, 'destroy'])
              ->name('profile.destroy');
     });

require __DIR__.'/auth.php';
