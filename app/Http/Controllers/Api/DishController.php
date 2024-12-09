<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    //
    public function index(){
        $dishes = Dish::all()->map(function ($dish) {

            $dish->image = $dish->image
            ? url('storage/' . $dish->image)
            : null;
            return $dish;
        });



        return response()->json(
            [
                "success" => true,
                "results" => $dishes,
            ]
            );
    }
}