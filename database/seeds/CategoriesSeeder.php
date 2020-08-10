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
            "Pin" => "split-cotter-pin.png",
            "Baut CB" => "baut-cb-rib-neck.jpg",
            "L Screw" => "baut-l-socket-cap-screw.jpg",
            "Nut" => "hex-nut.jpg",
            "Replacement Kit & Accessories" => "replacement-insert.jpg",
            "Washer" => "flat-washer.jpg",
            "Circlip" => "snap-ring-e.jpg",
            "Expansion Bolt" => "dyna-bolt.jpg",
            "Machine Screw" => "machine-screw-jf-plus.jpg",
            "Furniture Screw" => "dry-wall.jpg",
            "Bolt" => "hex-bolt.jpg",
            "Eye Bolt" => "eye-bolt.jpg",
            "Chemical" => "chemical-stud.jpg",
            "SDS" => "karet-roofing.jpg",
            'Welding' => "cd-stud.jpg",
            "Clamp" => "clamp-knalpot.jpg",
            "Stud" => "stud-bolt.jpg",
            "Rivet" => "blind-rivet.jpg",
            "Tool" => "allen-key.jpg",
            "Nipple" => "grease-nipple.jpg",
            "Knobstar" => "knobstar.jpg",
            "Automotive" => "manifold.jpg",
            "Accessories" => "cable-ties.jpg",
            "Customize" => "bushing.jpg",
            "Plastic" => "bts.jpg",
            "Baut 316L" => "baut-hexagon-ss-316l.jpg",
            "O Ring" => "o-ring-nbr-90-type-a.jpg"
        ];

        foreach ($categories as $name => $img) {
            DB::table('categories')->insert(['name' => $name, 'img' => $img]);
        }
    }
}
