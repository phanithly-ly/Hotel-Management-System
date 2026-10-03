<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::insert([
            // Standard (room_type_id = 1)
            ['room_number' => '101', 'room_type_id' => 1, 'floor' => 1, 'status' => 'available',  'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '102', 'room_type_id' => 1, 'floor' => 1, 'status' => 'occupied',   'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '103', 'room_type_id' => 1, 'floor' => 1, 'status' => 'available',  'description' => null, 'created_at' => now(), 'updated_at' => now()],

            // Deluxe (room_type_id = 2)
            ['room_number' => '201', 'room_type_id' => 2, 'floor' => 2, 'status' => 'available',  'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '202', 'room_type_id' => 2, 'floor' => 2, 'status' => 'maintenance','description' => 'AC under repair', 'created_at' => now(), 'updated_at' => now()],

            // Suite (room_type_id = 3)
            ['room_number' => '301', 'room_type_id' => 3, 'floor' => 3, 'status' => 'available',  'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '302', 'room_type_id' => 3, 'floor' => 3, 'status' => 'occupied',   'description' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}