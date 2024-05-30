<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'name' => 'fashion',
                'type' => 'Grocery',
                'latitude' => '8.5241',
                'longitude' => '76.9366',
            ],
            [
                'name' => 'Myg',
                'type' => 'Electronics',
                'latitude' => '8.5242',
                'longitude' => '76.9377',
            ],
            [
                'name' => 'Kalyan',
                'type' => 'Clothing',
                'latitude' => '8.5243',
                'longitude' => '76.9388',
            ],
        ]);
    }
}
