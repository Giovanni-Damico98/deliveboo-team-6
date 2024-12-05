<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dishes = [
            [
                "name" => "Carbonara",
                "description" => "Pasta con crema pecorino, pepe e uovo con aggiunta di guanciale croccante",
                "price" => 12.00,
                "restaurant_id" => 1,
                "visible" => true,
                "image" => "https://www.mamablip.com/storage/Traditional-Spaghetti-alla-Carbonara_1131611747132.jpg",
            ],
            [
                "name" => "Gricia",
                "description" => "Pasta con crema pecorino, parmigiano e pepe con aggiunta di guanciale croccante",
                "price" => 10.00,
                "restaurant_id" => 1,
                "visible" => true,
                "image" => "https://www.giallozafferano.it/images/219-21929/Pasta-alla-gricia_650x433_wm.jpg",
            ],
        ];

        foreach ($dishes as $dish) {
            $newDish = new Dish();
            $newDish->name = $dish["name"];
            $newDish->description = $dish["description"];
            $newDish->price = $dish["price"];
            $newDish->restaurant_id = $dish["restaurant_id"];
            $newDish->visible = $dish["visible"];
            $newDish->image = $dish["image"];
            $newDish->save();
        }
    }
}