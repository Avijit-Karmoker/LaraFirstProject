<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            'shipping_type' => "Inside Dhaka",
            'charge' => 50,
            'created_at' => now(),
        ]);

        DB::table('shippings')->insert([
            'shipping_type' => "Outside Dhaka",
            'charge' => 110,
            'created_at' => now(),
        ]);

        DB::table('shippings')->insert([
            'shipping_type' => "Shipping charge free",
            'charge' => 0,
            'created_at' => now(),
        ]);
    }
}
