<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
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

// All admin routes

Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

Route::get('get-districts/{division_id}', [HomeController::class, 'getDistricts']);

Route::group(['prefix'=>'admin'], function () {
    // Route::get('/registration', [AdminController::class, 'index'])->name('registration.index');
    // Route::get('/registration/create', [AdminController::class, 'create'])->name('registration.create');
    // Route::post('/registration/store', [AdminController::class, 'store'])->name('registration.store');
    // Route::get('/registration/delete/{id}', [AdminController::class, 'destroy'])->name('registration.destroy');
    // Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('registration.edit');
    // Route::get('/update/{id}', [AdminController::class, 'update'])->name('registration.update');

    Route::resource('registration', AdminController::class);
    

});







Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
