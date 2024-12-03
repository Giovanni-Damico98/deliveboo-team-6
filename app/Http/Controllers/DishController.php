<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware("auth");
    }


    public function index()
    {
        //
        $dishes = Dish::all();
        return view("admin.dishes.index", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dishes = Dish::all();
        return view('admin.dishes.create', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|decimal:2',
            'image' => 'nullable|url:http,https',
        ]);

        $dish = new Dish();

        $dish->fill($formData);
        $dish->save();

        return redirect()->route("admin.dishes.show", $dish->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
        // $dish = Dish::findOrFail($id);
        return view("admin.dishes.show", compact("dish"));
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
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route("admin.dishes.delete");
    }
}