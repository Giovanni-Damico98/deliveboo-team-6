<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Metodo index per creare l'endpoint
    public function index(Request $request)
    {
        $query = Restaurant::with('categories');

        //controllo che siano state selezionate uno o piu categorie
        if ($request->has('categories') && is_array($request->categories)) {
            $categories = $request->categories;

            //filtro i ristoranti in base alle categorie che vengono ricercate
            $query->whereHas('categories', function ($q) use ($categories) {
                $q->whereIn('categories.id', $categories);
            }, '=', count($categories));
        }

        $restaurants = $query->get();

        $restaurants->map(function ($restaurant) {
            $restaurant->image = $restaurant->image ? url('storage/' . $restaurant->image) : null;
            return $restaurant;
        });

        return response()->json([
            "success" => true,
            "results" => $restaurants,
        ]);
    }

    public function show($slug)
{
    // Recupera il ristorante tramite slug, inclusi categorie e piatti
    $restaurant = Restaurant::with(['categories', 'dishes'])->where('slug', $slug)->first();

    // Controlla se il ristorante esiste
    if (!$restaurant) {
        return response()->json([
            'success' => false,
            'message' => 'Restaurant not found',
        ], 404);
    }

    // Aggiunge il percorso completo per l'immagine del ristorante
    $restaurant->image = $restaurant->image ? url('storage/' . $restaurant->image) : null;

    return response()->json([
        'success' => true,
        'results' => $restaurant,
    ]);
}
}