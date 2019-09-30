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
            [ 'name' => 'Fast food outlet'],
            [ 'name' => 'Restaurant'],
            [ 'name' => 'Grocery'],
            [ 'name' => 'Electronics']
        ];

        foreach ($leagues as $league)
        {
            League::create($league);
        }
    }
}
