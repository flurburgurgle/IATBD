<?php

use App\Http\Controllers\ToolController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\tool;

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

Route::get('tools.allTools', [ToolController::class, 'allTools'])->name('tools.allTools');
Route::get('tools.dashboard', [ToolController::class, 'dashboard'])->name('tools.dashboard');
Route::delete('tools.{tool}.destroyLoan', [ToolController::class, 'destroyLoan'])->name('tools.destroyLoan');
Route::get('tools.{tool}.review', [ToolController::class, 'review'])->name('tools.review');

Route::get('users.index/{user}', [Usercontroller::class, 'index'])->name('users.index');
Route::get('users.ban/{user}', [Usercontroller::class, 'ban'])->name('users.ban');
Route::get('users.banpage/{user}', [Usercontroller::class, 'banpage'])->name('users.banpage');


Route::get('/dashboard', function () {
    return redirect('tools.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tools', ToolController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'allTools', 'dashboard', 'destroyLoan', 'review'])
    ->middleware(['auth', 'verified']);

Route::resource('images', ImageController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('tools.loans', LoanController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('users', UserController::class)
    ->only(['index/{user}', 'ban/{user}', 'banpage/{user}']);

require __DIR__.'/auth.php';
