<?php

use App\Township;
use Illuminate\Database\Seeder;

class TownshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $townships = ['Sanchaung', 'Hlaing', 'Kamayut', 'Ahlone', 'Bahan'];

        // foreach($townships as $township) {
            for($i = 0; $i < 5; $i++) {
            Township::create([
                'name' => $townships[$i]
            ]);
        }
    }
}
