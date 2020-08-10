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
            "Besi" => "hollow-anchor.jpg",
            "Stainless A2 / 304" => "dowel-pin-pull-out.jpg",
            "Stainless A4 / 316" => "baut-cb-rib-neck.jpg",
            "Baja" => "self-push-nut.jpg",
            "HDG" => "baut-cb-round-neck-square-head.jpg",
            "Zinc Plate" => "baut-l-socket-cap-screw.jpg",
            "Alloy" => "socket-set-screw.jpg",
            "Stainless B8" => "heavy-hex-nut.jpg",
            "Stainless B8M" => "heavy-hex-nut.jpg",
            "Plain" => "eye-nut.jpg",
            "Nickel" => "d-nipple.jpg",
            "YZ" => "jp-set.jpg",
            "Stainless A4 L / 316L" => "hex-nut.jpg",
            "Nylon" => "viser.jpg",
            "Brass" => "wood-screw-flat.jpg",
            "Zinc Flake" => "nord-lock.jpg",
            "Zinc Mech" => "contact-washer-pointed.jpg",
            "Steel" => "paku-beton.jpg",
            "Black" => "tapping-bo-thread-jt-plus.jpg",
            "Karet" => "karet-roofing.jpg",
            "Stainless 420" => "snap-ring-h.jpg",
            "Stainless 305" => "sds-jf.jpg",
            "Copper Zinc" => "cd-stud.jpg",
            "Alumi / SS 304" => "blind-rivet.jpg",
            "Aluminium" => "tumbular-round-head.jpg",
            "40CR" => "magnetic-nut-setter.jpg",
            "Lime Pointue" => "nicholson-taper-file.jpg",
            "Plastik" => "knobstar.jpg"
        ];

        foreach ($materials as $name => $img) {
            DB::table('materials')->insert(['name' => $name, 'img' => $img]);
        }
    }
}
