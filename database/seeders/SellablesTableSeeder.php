<?php

namespace Database\Seeders;

use App\Models\Sellable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SellablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellables = require database_path("data/SellablesData.php");

        foreach ($sellables as $sellable) {

            Sellable::create([

                "name" => $sellable["name"],
                "slug" => Str::slug($sellable["name"]),
                "description" => $sellable["description"],
                "price" => $sellable["price"],
                "image" => $sellable["image"],
                "is_visible" => $sellable["is_visible"],
                "category_id" => $sellable["category_id"],
                
            ]);

        }
    }
}
