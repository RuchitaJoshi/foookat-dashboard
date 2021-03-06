<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            [
                'name' => 'Store A',
                'overview' => 'Food outlet',
                'address' => 'Prahlad Nagar',
                'city' => 'Ahmedabad',
                'zip_code' => 380015,
                'latitude' => 23.012034,
                'longitude' => 72.510754,
                'logo' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat_andrd_icon.png',
                'email' => 'storea@gmail.com',
                'mobile_number' => '+917043307711',
                'phone_number' => '07926605145',
                'mon_open' => '10:00:00',
                'mon_close' => '23:30:00',
                'tue_open' => '10:00:00',
                'tue_close' => '23:30:00',
                'wed_open' => '10:00:00',
                'wed_close' => '23:30:00',
                'thu_open' => '10:00:00',
                'thu_close' => '23:30:00',
                'fri_open' => '10:00:00',
                'fri_close' => '23:30:00',
                'sat_open' => '10:00:00',
                'sat_close' => '23:30:00',
                'sun_open' => '10:00:00',
                'sun_close' => '23:30:00',
                'cover_image1' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat-orange.png',
                'cover_image2' => null,
                'cover_image3' => null,
                'league_id' => 1,
                'city_id' => 1,
                'business_id' => 1,
                'active' => 1,
                'approved' => 'Approved'
            ],
            [
                'name' => 'Store B',
                'overview' => 'Restaurant',
                'address' => 'Navrangpura',
                'city' => 'Ahmedabad',
                'zip_code' => 380009,
                'latitude' => 23.036544,
                'longitude' => 72.561139,
                'logo' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat_andrd_icon.png',
                'email' => 'storeb@gmail.com',
                'mobile_number' => '+917043307711',
                'phone_number' => null,
                'mon_open' => '10:00:00',
                'mon_close' => '23:30:00',
                'tue_open' => '10:00:00',
                'tue_close' => '23:30:00',
                'wed_open' => '10:00:00',
                'wed_close' => '23:30:00',
                'thu_open' => '10:00:00',
                'thu_close' => '23:30:00',
                'fri_open' => '10:00:00',
                'fri_close' => '23:30:00',
                'sat_open' => '10:00:00',
                'sat_close' => '23:30:00',
                'sun_open' => '10:00:00',
                'sun_close' => '23:30:00',
                'cover_image1' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat-orange.png',
                'cover_image2' => null,
                'cover_image3' => null,
                'league_id' => 2,
                'city_id' => 1,
                'business_id' => 1,
                'active' => 1,
                'approved' => 'Approved'
            ],
            [
                'name' => 'Store C',
                'overview' => 'Grocery Store',
                'address' => 'Shahibaug',
                'city' => 'Ahmedabad',
                'zip_code' => 380004,
                'latitude' => 23.708381,
                'longitude' => 72.534162,
                'logo' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat_andrd_icon.png',
                'email' => null,
                'mobile_number' => '+917043307711',
                'phone_number' => null,
                'mon_open' => '10:00:00',
                'mon_close' => '18:00:00',
                'tue_open' => '10:00:00',
                'tue_close' => '18:00:00',
                'wed_open' => '10:00:00',
                'wed_close' => '18:00:00',
                'thu_open' => '10:00:00',
                'thu_close' => '18:00:00',
                'fri_open' => '10:00:00',
                'fri_close' => '18:00:00',
                'sat_open' => '10:00:00',
                'sat_close' => '18:00:00',
                'sun_open' => '00:00:00',
                'sun_close' => '00:00:00',
                'cover_image1' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat-orange.png',
                'cover_image2' => null,
                'cover_image3' => null,
                'league_id' => 3,
                'city_id' => 1,
                'business_id' => 1,
                'active' => 1,
                'approved' => 'Approved'
            ],
            [
                'name' => 'Store D',
                'overview' => 'Electronics',
                'address' => 'Maninagar',
                'city' => 'Ahmedabad',
                'zip_code' => 380008,
                'latitude' => 22.996170,
                'longitude' => 72.599584,
                'logo' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat_andrd_icon.png',
                'email' => 'stored@gmail.com',
                'mobile_number' => null,
                'phone_number' => null,
                'mon_open' => '10:00:00',
                'mon_close' => '18:00:00',
                'tue_open' => '10:00:00',
                'tue_close' => '18:00:00',
                'wed_open' => '10:00:00',
                'wed_close' => '18:00:00',
                'thu_open' => '10:00:00',
                'thu_close' => '18:00:00',
                'fri_open' => '10:00:00',
                'fri_close' => '18:00:00',
                'sat_open' => '00:00:00',
                'sat_close' => '00:00:00',
                'sun_open' => '00:00:00',
                'sun_close' => '00:00:00',
                'cover_image1' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat-orange.png',
                'cover_image2' => null,
                'cover_image3' => null,
                'league_id' => 4,
                'city_id' => 1,
                'business_id' => 1,
                'active' => 1,
                'approved' => 'Approved'
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}