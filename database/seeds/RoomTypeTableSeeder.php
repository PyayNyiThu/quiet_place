<?php

use App\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room_types = ['Event Room', 'Meeting Room', 'Class Room'];

            foreach($room_types as $room_type) {
            RoomType::create([
                'name' => $room_type
            ]);
        }
    }
}
