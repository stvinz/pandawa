<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $brands = [
            'Recoil',
            'Filtec',
            'Fisher',
            'Ramset',
            'Nachi',
            'Projobber',
            'Skc',
            'Nikkon',
        ];

        foreach ($brands as $name) {
            DB::table('brands')->insert(['name' => $name]);
        }
    }
}
