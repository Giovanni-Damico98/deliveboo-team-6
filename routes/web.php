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
    Route::get("/dishes/create", [DishController::class, "create"])->name("dishes.create");
    Route::post("/dishes", [DishController::class, "store"])->name("dishes.store");

    // Rotta per il singolo piatto
    Route::get("/dishes/{dish}", [DishController::class, "show"])->name("dishes.show");

    // Rotta per la modifica dei piatti
    Route::get("/dishes/{dish}/edit", [DishController::class, "edit"])->name("dishes.edit");

    //
    Route::put("/dishes/{dish}/update", [DishController::class, "update"])->name("dishes.update");

    // Rotta per l'eliminazione dei piatti
    Route::delete("/dishes/{dish}/delete", [DishController::class, "destroy"])->name("dishes.delete");
});

// uri: -> Uniform Resource Identifier