<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [ 'name' => 'Gujarat'],
            [ 'name' => 'Rajasthan']
        ];

        foreach ($states as $state)
        {
            State::create($state);
        }
    }
}
