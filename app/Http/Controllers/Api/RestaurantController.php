<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Metodo index per creare l'endpoint
    public function index()
    {
        $restaurants = Restaurant::all()->map(function ($restaurant) {

            $restaurant->image = $restaurant->image
            ? url('storage/' . $restaurant->image)
            : null;
            return $restaurant;
        });

        return response()->json(
            [
                "success" => true,
                "results" => $restaurants,
            ]
        );
    }
}
