<?php

use App\Room;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        $price = ['20000', '30000', '40000', '50000'];
        $class = ['class1.jpg', 'class2.jpeg', 'class3.jpeg', 'class4.jpg', 'class5.jpeg'];
        $event = ['event1.jpg', 'event2.jpg', 'event3.jpg','event4.jpg','event5.jpg'];
        $meeting = ['meeting1.jpg', 'meeting2.jpg', 'meeting3.jpg', 'meeting4.jpg', 'meeting5.jpg'];
        $size = ['200', '300', '400', '500'];
        $capacity = ['250', '350', '450', '550'];

        for ($i = 0; $i < 50; $i++) {
            $roomtype_id = rand(1, 3);
            if($roomtype_id == 1) {
                $photo = 'storage/image/'.$event[array_rand($event)];
            } else if($roomtype_id == 2) {
                $photo = 'storage/image/'.$meeting[array_rand($meeting)];
            } else if($roomtype_id == 3) {
                $photo = 'storage/image/'.$class[array_rand($class)];
            }
            Room::create([
                'price' => $price[array_rand($price)],
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur voluptates autem adipisci totam.',
                'photo' => $photo,
                'roomtype_id' => $roomtype_id,
                'township_id' => rand(1, 5),
                'size' => $size[array_rand($size)],
                'capacity' => $capacity[array_rand($capacity)],
            ]);
        }
    }
}
