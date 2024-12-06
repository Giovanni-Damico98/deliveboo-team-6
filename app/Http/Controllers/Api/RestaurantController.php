<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // metodo index per creare l'end point
    public function index(){
        $restaurants = Restaurant::all();

        return response()->json(
            [
                "success" => true,
                "results" => $restaurants,
            ]
            );
    }

}
