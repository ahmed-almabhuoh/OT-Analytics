<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\AuthenticationController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('map', function () {
    return view('view');
});


Route::get('/', function () {
    return redirect()->route('login', 'admin');
});

Route::prefix('ot')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard.admin');

    Route::resource('admins', AdminController::class);
    Route::resource('contributors', ContributorController::class);

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::prefix('ot')->middleware(['guest:admin'])->group(function () {
    Route::get('{guard}/login', [AuthenticationController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login']);
});
