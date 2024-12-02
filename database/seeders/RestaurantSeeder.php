<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $restaurants = [
          $name = "Dar Romano",
          $address = "Via le mani dal naso 1",
          $vat_number = 123567345612,
          $image = "example.com",
          $user_id = 1,
        ];

        foreach ($restaurants as $restaurant){
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $name;
            $newRestaurant->address = $address;
            $newRestaurant->vat_number = $vat_number;
            $newRestaurant->image = $image;
            $newRestaurant->user_id = $user_id;
            $newRestaurant->save();
        }
    }
}
