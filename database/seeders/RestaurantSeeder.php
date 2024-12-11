<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $restaurants = [
        [
            "name" => "Dar Bottarolo",
            "address" => "Via le mani dal naso 1",
            "vat_number" => 123567345612,
            "image" => "restaurant_images/WhatsApp-Image-2023-02-15-at-15.43.41.webp",
            "user_id" => 1,
        ]

        ];

        foreach ($restaurants as $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $restaurant["name"];
            $newRestaurant->address = $restaurant["address"];
            $newRestaurant->vat_number = $restaurant["vat_number"];
            $newRestaurant->image = $restaurant["image"];
            $newRestaurant->user_id = $restaurant["user_id"];


            $newRestaurant->slug = Str::slug($restaurant["name"], '-');

            $newRestaurant->save();
        }
    }
}