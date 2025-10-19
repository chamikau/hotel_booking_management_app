<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Deluxe Room',
                'location' => 'Colombo',
                'description' => 'Luxury room with sea view.',
                'price' => 15000.00,
                'image' => 'deluxe.png',
                'guests' => 2,
            ],
            [
                'name' => 'Standard Room',
                'location' => 'Kandy',
                'description' => 'Comfortable room perfect for couples.',
                'price' => 10000.00,
                'image' => 'standard.png',
                'guests' => 2,
            ],
            [
                'name' => 'Family Room',
                'location' => 'Galle',
                'description' => 'Spacious room for families.',
                'price' => 20000.00,
                'image' => 'family.png',
                'guests' => 4,
            ],
        ]);
    }
}
