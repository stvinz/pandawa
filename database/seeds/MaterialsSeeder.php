<?php

use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $materials = [
            "Besi",
            "Stainless A2 / 304",
            "Stainless A4 / 316",
            "Baja",
            "HDG",
            "Zinc Plate",
            "Alloy",
            "Stainless B8",
            "Stainless B8M",
            "Plain",
            "Nickel",
            "YZ",
            "Stainless A4 L / 316L",
            "Nylon",
            "Brass",
            "Zinc Flake",
            "Zinc Mech",
            "Steel",
            "Black",
            "Karet",
            "Stainless 420",
            "Stainless 305",
            "Copper Zinc",
            "Alumi / SS 304",
            "Aluminium",
            "40CR",
            "Lime Pointue",
            "Plastik"
        ];

        foreach ($materials as $material) {
            DB::table('materials')->insert(['name' => $material]);
        }
    }
}
