<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = require database_path("data/CategoriesData.php");

        foreach ($categories as $category) {

            Category::create([

                "name" => $category["name"],
                "slug" => Str::slug($category["name"]),
                "description" => $category["description"],

            ]);
        }
    }
}
