<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(Township::class, 5)->create();
        $this->call(TownshipTableSeeder::class);
        $this->call(RoomTypeTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(RoomTableSeeder::class);
        $this->call(RoomServiceTableSeeder::class);
    }
}
