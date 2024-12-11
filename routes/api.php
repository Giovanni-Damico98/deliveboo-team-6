<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\OrderController;
use App\Mail\EmailNotification;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// /api/{nome della route} per ricevere l'end-point
Route::get("/restaurants" , [RestaurantController::class , "index"])->name("api.restaurants.index");
Route::get("/restaurants/{slug}", [RestaurantController::class, "show"])->name("api.restaurants.show");

Route::get("/category" , [CategoryController::class , "index"])->name("api.category.index");

// Rotta per l'esposizione dell'api per dishes
Route::get("/dishes", [DishController::class, "index"])->name("api.dishes.index");

// Rotta per l'invio di e-mail
Route::post('/send-email' , function (Request $request){
    $restaurant = Restaurant::all();
    $details = $request->validate([
        'title' => 'required|string',
        'body' => 'required|string',
        'to' => 'required|email',
    ]);

    // Recupero l'email dal database in modo dinamico
    $databaseEmail = User::where('id')->value('email');

    // Invia email al destinatario inserito nel form
    Mail::to($details['to'])->send(new EmailNotification([
        'title' => $details['details'],
        'body' => "Il tuo ordine presso il {{$restaurant->name}} è stato confermato "
    ]));

    //Invia email all'indirizzo del database
    Mail::to($databaseEmail)->send(new EmailNotification([
        'title' => $details['title'],
        'body' => "Hai ricevuto un ordine"
    ]));
});

// Rotta per prendere i dati del ordine dal front

Route::post('/orders' , [OrderController::class , 'store']);

// Rotta per prendere i dati del ordine dal front

Route::post('/orders' , [OrderController::class , 'store']);