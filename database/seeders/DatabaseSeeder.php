<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoomTypeSeeder::class,
            RoomSeeder::class,   // ត្រូវរត់ក្រោយ RoomTypeSeeder ព្រោះ rooms ត្រូវការ room_type_id
        ]);
    }
}