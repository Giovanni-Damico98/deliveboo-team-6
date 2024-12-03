<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Auth::routes();
Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'index'])->name('dashboard');
});

Route::prefix("/admin")->name("admin.")->group(function () {
    Route::get("/dishes", [DishController::class, "index"])->name("dishes.index");

    Route::get("/dishes/show/{dish}", [DishController::class, "show"])->name("dishes.show");

    Route::delete("/dishes/delete/{dish}", [DishController::class, "destroy"])->name("dishes.delete");
});
