<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [ 'name' => 'Ahmedabad', 'state_id' => 1, 'active' =>  1],
            [ 'name' => 'Gandhinagar', 'state_id' => 1, 'active' =>  1],
            [ 'name' => 'Surat', 'state_id' => 1, 'active' =>  1],
            [ 'name' => 'Baroda', 'state_id' => 1, 'active' =>  1],
            [ 'name' => 'Rajkot', 'state_id' => 1, 'active' =>  1]
        ];

        foreach ($cities as $city)
        {
            City::create($city);
        }
    }
}
