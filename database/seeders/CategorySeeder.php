<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoriesNames =
        [
            "Italiano",
            "Cinese",
            "Giapponese",
            "Poke",
            "Burgers",
            "Indiano",
            "Messicano",
            "Pizzeria",
            "Burritos",
            "Bakery",
            "Greco",
            "Vegano",
        ];

        foreach($categoriesNames as $name){
            $newCategory = new Category();
            $newCategory->name = $name;
            $newCategory->save();
        };
    }
}
