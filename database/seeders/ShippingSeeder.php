<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping = new Shipping();
        $shipping->country = "Spain";
        $shipping->price_eur = 15;
        $shipping->price_nok = 150;
        $shipping->save();

        $shipping = new Shipping();
        $shipping->country = "Norway";
        $shipping->price_eur = 10;
        $shipping->price_nok = 100;
        $shipping->save();
    }
}
