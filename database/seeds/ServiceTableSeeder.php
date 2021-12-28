<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Wifi', 'Table', 'Chair', 'Projector', 'Whiteboard', 'Aircon'];
        $photo = ['wifi.png', 'table.png', 'chair.png', 'projector.png', 'whiteboard.png', 'aircon.png'];

        for($i = 0; $i <6; $i++) {
            Service::create([
                'name' => $name[$i],
                'photo' => 'storage/image/'.$photo[$i],
            ]);
        }
    }
}
