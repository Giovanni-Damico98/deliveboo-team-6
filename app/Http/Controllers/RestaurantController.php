<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, Restaurant $restaurant)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();
        $restaurantCategories = Restaurant::with('categories')->findOrFail($category);
        // test
        if (!$restaurant) {
            return redirect()->route('restaurant.create')->with('message', 'Per favore crea prima il tuo ristorante');
        }
        return view('admin.dashboard', compact('restaurant', 'restaurantCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $users = User::all();
        // return view('', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'vat_number' => 'required|bigInteger',
            'image' => 'required|url:http,https',
            'user_id' => 'required|string',
        ],
    );

        $restaurant = new Restaurant();

        $restaurant->fill($formData);
        $restaurant->user_id = $formData['user_id'];


        $restaurant->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
