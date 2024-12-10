<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'restaurant_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vat_number' => ['required', 'numeric', 'string', 'min:1'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'categories' => ['required']
        ],
        [
            'name.max' => 'Il nome non deve contenere più di 50 caratteri',
            'name.required' => 'Il nome è obbligatorio',
            'email.required' => 'Lemail è obbligatoria',
            'email.email' => 'L\'email deve essere valida',
            'email.unique' => 'L\'email è già stata utillizata',
            'password.required' => 'La password è obbligatoria',
            'password.min' => 'La password deve essere più lunga di 8 caratteri',
            'password.confirmed' => 'Le password devono corrispondere',
            'restaurant_name.required' => 'Il nome deve essere obbligatorio',
            'address.required' => 'L\'indirizzo è obbligatorio',
            'vat_number.required'=> 'La P.IVA è obbligatoria',
            'vat_number.numeric' => 'La P.IVA non può contenere lettere',
            // 'vat_number.max' => 'La P.IVA non può essere più lunga di 15 caratteri',
            'image.required' => 'Un immagine è obbligatoria',
            'image.image' => 'Deve essere un immagine',
            'image.mimes' => 'Il formato non viene supportato',
            'categories.required' => 'Scegli almeno una categoria',
        ],
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dati di creazione per l'utente
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $imagePath = null;
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('restaurant_images', 'public');
        }


        // ristorante associato all'utente
        $restaurant = Restaurant::create([
            'name' => $data['restaurant_name'],
            'address' => $data['address'],
            'vat_number' => $data['vat_number'],
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        // associo le categorie selezionate dall'utente all'id del ristorante appena creato nella
        // tabella pivot category_restaurant
        if (isset($data['categories'])) {
            $restaurant->categories()->sync($data['categories']);
        }


        return $user;
    }
    public function showRegistrationForm()
    {
        $categories = Category::all();

        return view("auth.register", compact("categories"));
    }
}
