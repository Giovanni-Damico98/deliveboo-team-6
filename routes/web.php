<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OrderController;
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


// Route::get('register', [RegisterController::class , "showRegistrationForm"])->name("register");
// Route::post('register', [RegisterController::class , "register"]);


Auth::routes();
Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'index'])->name('dashboard');
});

Route::prefix("/admin")->name("admin.")->group(function () {
    Route::get("/dishes", [DishController::class, "index"])->name("dishes.index");
    Route::get("/dishes/create", [DishController::class, "create"])->name("dishes.create");
    Route::get('/dishes/trashed' , [DishController::class , "trashed"])->name("dishes.trashed");
    // Rotta per salvare nel database i nuovi dati creati
    Route::post("/dishes", [DishController::class, "store"])->name("dishes.store");

    // Rotta per il singolo piatto
    Route::get("/dishes/{dish}", [DishController::class, "show"])->name("dishes.show");

    // Rotta per la modifica dei piatti
    Route::get("/dishes/{dish}/edit", [DishController::class, "edit"])->name("dishes.edit");

    //
    Route::put("/dishes/{dish}/update", [DishController::class, "update"])->name("dishes.update");

    // Rotta per l'eliminazione dei piatti
    Route::delete("/dishes/{dish}/delete", [DishController::class, "destroy"])->name("dishes.delete");

    Route::patch("/dishes/{id}/restore", [DishController::class, "restore"])->name("dishes.restore");
    Route::delete("/dishes/{id}/force-delete", [DishController::class, "forceDelete"])->name("dishes.forceDelete");

    Route::post('/dishes/{dish}/toggle', [DishController::class, 'toggle'])->name('dishes.toggle');
});

// ROTTE PER GLI ORDINI
Route::get("/admin/orders", [OrderController::class, "index"])->name("admin.orders.index");
Route::get('/admin/orders/completed', [OrderController::class, 'completed'])->name('admin.orders.completed');
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
Route::post('/admin/orders/{order}/complete', [OrderController::class, 'complete'])->name('admin.orders.complete');

// ROTTA PER LE STATISTICHE DEGLI ORDINI
Route::get('/admin/charts', [OrderController::class, 'showChart'])->name('admin.charts.index');

// uri: -> Uniform Resource Identifier
