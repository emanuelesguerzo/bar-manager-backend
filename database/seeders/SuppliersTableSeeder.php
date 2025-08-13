<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = require database_path("data/SuppliersData.php");

        foreach ($suppliers as $supplier) {

            Supplier::create([

                "name" => $supplier["name"],
                "slug" => Str::slug($supplier["name"]),
                "email" => $supplier["email"],
                "phone" => $supplier["phone"],

            ]);

        }
    }
}
