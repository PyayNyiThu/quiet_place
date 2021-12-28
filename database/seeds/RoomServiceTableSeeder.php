<?php

use App\Helpers\RoomServiceIdGenerate;
use App\RoomService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = mt_rand(180, 250);

        for ($i = 0; $i < $length; $i++) {
            $room_id = mt_rand(1, 50);
            // $service_id = RoomServiceIdGenerate::serviceId();
            $service_id = mt_rand(1, 6);

            if (RoomService::where('room_id', $room_id)->where('service_id', $service_id)->exists()) {
                $service_id = 7;
            }

            RoomService::create([
                'room_id' => $room_id,
                'service_id' => $service_id
            ]);

        }
        RoomService::where('service_id', 7)->delete();
    }
}
