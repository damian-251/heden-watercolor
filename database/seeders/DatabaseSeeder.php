<?php

namespace Database\Seeders;

use Illuminate\Cache\TagSet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        $this->call(LocationSeeder::class);
        $this->call(ColourSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ShippingSeeder::class);
    }
}
