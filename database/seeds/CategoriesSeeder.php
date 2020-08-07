<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Pin",
            "Baut CB",
            "L Screw",
            "Nut",
            "Replacement Kit & Accessories",
            "Washer",
            "Circlip",
            "Expansion Bolt",
            "Machine Screw",
            "Furniture Screw",
            "Bolt",
            "Eye Bolt",
            "Chemical",
            "SDS",
            'Welding',
            "Clamp",
            "Stud",
            "Rivet",
            "Tool",
            "Nipple",
            "Knobstar",
            "Automotive",
            "Accessories",
            "Customize",
            "Plastic",
            "Baut 316L",
            "O Ring"
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert(['name' => $category]);
        }
    }
}
