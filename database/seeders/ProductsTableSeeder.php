<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = require database_path("data/ProductsData.php");

        foreach ($products as $product) {

            Product::create([

                "name" => $product["name"],
                "brand" => $product["brand"],
                "price" => $product["price"],
                "unit_size_ml" => $product["unit_size_ml"],
                "unit_size_g" => $product["unit_size_g"],
                "image" => $product["image"],
                "supplier_id" => $product["supplier_id"],

            ]);
        }
    }
}
