<?php

use App\Http\Controllers\DishController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix("/admin")->name("admin.")->group(function(){
    Route::get("/dishes" , [DishController::class , "index"])->name("dishes.index");
    Route::get("/dishes/create", [DishController::class, "create"])->name("dishes.create");
    Route::get("/projects", [DishController::class, "store"])->name("dishes.store");
});