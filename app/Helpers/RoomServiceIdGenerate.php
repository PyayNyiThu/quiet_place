<?php

namespace App\Helpers;

use App\RoomService;

class RoomServiceIdGenerate
{
    public static function serviceId()
    {
        $service_id = mt_rand(0, 6);

        if (RoomService::where('service_id', $service_id)->exists()) {
            self::serviceId();
        }

        return $service_id;
    }
}
