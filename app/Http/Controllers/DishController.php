<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

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

        // Todo: first()-> recupera il primo record che soddisfa la condizione
        $restaurant = Restaurant::where('user_id', auth()->id())->first();
        if (!$restaurant) {
            return redirect()->route('dashboard')->with('error', 'devi prima creare un ristorante');
        }

        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        return view("admin.dishes.index", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $restaurants = Restaurant::all();
        return view('admin.dishes.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $formData = $request->validate([
        'name' => 'required|string|max:50',
        'description' => 'nullable|string|max:255',
        'price' => 'required|numeric|min:0.10|max:999',
        'visible' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ], [
        'name.max' => 'La lunghezza del nome deve avere massimo 50 caratteri',
        'description.max' => 'La lunghezza della descrizione deve avere massimo 255 caratteri',
        'price.min' => 'Il prezzo non deve essere inferiore a 0 euro',
        'price.max' => 'Il prezzo non deve essere superiore a 999 euro',
        'visible.boolean' => 'È necessario selezionare la disponibilità del piatto',
        'image.max' => 'Il file non deve superare i 2048mb',
    ]);

    $restaurant = Restaurant::where('user_id', auth()->id())->first();
    if (!$restaurant) {
        return redirect()->route('dashboard')->with('error', 'Devi prima creare un ristorante.');
    }

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('dish_images', 'public');
    }

    Dish::create([
        'name' => $formData['name'],
        'description' => $formData['description'],
        'price' => $formData['price'],
        'visible' => $formData['visible'],
        'image' => $imagePath,
        'restaurant_id' => $restaurant->id,
    ]);

    return redirect()->route("admin.dishes.index")->with('success', 'Piatto creato con successo!');
}

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view("admin.dishes.show", compact("dish"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $dish = Dish::findOrFail($id);
        return view("admin.dishes.edit", compact("dish"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validazione dei dati
        $formData = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.10|max:999',
            'visible' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.max' => 'La lunghezza del nome deve avere massimo 50 caratteri',
            'description.max' => 'La lunghezza della descrizione deve avere massimo 255 caratteri',
            'price.min' => 'Il prezzo non deve essere inferiore a 0 euro',
            'price.max' => 'Il prezzo non deve essere superiore a 999 euro',
            'visible.boolean' => 'È necessario selezionare la disponibilità del piatto',
            'image.max' => 'Il file non deve superare i 2048mb',
        ]);

        // Trova il piatto da modificare
        $dish = Dish::findOrFail($id);

        // Gestione del caricamento della nuova immagine
        $imagePath = $dish->image; // Manteniamo l'immagine attuale se non viene caricata una nuova
        if ($request->hasFile('image')) {
            // Elimina l'immagine precedente se esiste
            if ($dish->image) {
                Storage::disk('public')->delete($dish->image);
            }

            // Salva la nuova immagine
            $imagePath = $request->file('image')->store('dish_images', 'public');
        }

        // Aggiorna i dati del piatto
        $dish->update([
            'name' => $formData['name'],
            'description' => $formData['description'],
            'price' => $formData['price'],
            'visible' => $formData['visible'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dishes.index')->with('message', 'Piatto aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //
        // $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route("admin.dishes.index");
    }

    public function trashed(){
        $trashedDishes = Dish::onlyTrashed()->get();
        return view ("admin.dishes.trashed", compact("trashedDishes"));
    }

    public function restore(string $id){
        $dish = Dish::onlyTrashed()->findOrFail($id);
        $dish->restore();

        return redirect()->route("admin.dishes.trashed")->with("success" , "Ripristinato con Successo");
    }

    public function forceDelete(string $id){
        $dish = Dish::onlyTrashed()->findOrFail($id);
        $dish->forceDelete();

        return redirect()->route("admin.dishes.trashed")->with("success" , "Eliminato con Successo");
    }

    public function toggle(Dish $dish)
{
    $dish->visible = !$dish->visible;
    $dish->save();

    return redirect()->route('admin.dishes.index')->with('success', 'Stato del piatto aggiornato con successo.');
}
}
