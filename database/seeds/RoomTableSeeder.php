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
        $faker = Faker::create();
        $price = ['20000', '30000', '40000', '50000'];
        $class = ['class1.jpeg', 'class2.jpg', 'class3.jpg', 'class4.jpeg', 'class5.jpg'];
        $event = ['event1.jpg', 'event2.jpg', 'event3.jpg','event4.jpg','event5.jpg'];
        $meeting = ['meeting1.jpeg', 'meeting2.jpg', 'meeting3.jpeg', 'meeting4.jpg', 'meeting5.jpg'];
        $size = ['200', '300', '400', '500'];
        $capacity = ['250', '350', '450', '550'];

        for ($i = 0; $i < 50; $i++) {
            $roomtype_id = rand(1, 3);
            if($roomtype_id == 1) {
                $photo = 'backend/images/'.$event[array_rand($event)];
            } else if($roomtype_id == 2) {
                $photo = 'backend/images/'.$meeting[array_rand($meeting)];
            } else if($roomtype_id == 3) {
                $photo = 'backend/images/'.$class[array_rand($class)];
            }
            Room::create([
                'price' => $price[array_rand($price)],
                'description' => $faker->sentence,
                'photo' => $photo,
                'roomtype_id' => $roomtype_id,
                'township_id' => rand(1, 5),
                'size' => $size[array_rand($size)],
                'capacity' => $capacity[array_rand($capacity)],
            ]);
        }
    }
}
