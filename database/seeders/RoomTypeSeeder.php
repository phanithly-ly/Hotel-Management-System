<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        RoomType::insert([
            [
                'type_name' => 'Standard',
                'price_per_night' => 35.00,
                'capacity' => 2,
                'description' => 'Comfortable room with basic amenities, ideal for solo travelers or couples.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Deluxe',
                'price_per_night' => 65.00,
                'capacity' => 3,
                'description' => 'Spacious room with city view, mini bar, and premium bedding.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Suite',
                'price_per_night' => 120.00,
                'capacity' => 4,
                'description' => 'Luxury suite with separate living area, perfect for families or VIP guests.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}