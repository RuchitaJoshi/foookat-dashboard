<?php

use App\League;
use Illuminate\Database\Seeder;

class LeaguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leagues = [
            [ 'name' => 'Restaurant']
        ];

        foreach ($leagues as $league)
        {
            League::create($league);
        }
    }
}
