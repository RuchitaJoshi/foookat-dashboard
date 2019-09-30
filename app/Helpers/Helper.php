<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helper
{
    /**
     * Get cities
     *
     * @param $state
     * @return mixed
     */
    public  static function  getCities($state)
    {
        $cities = DB::table('cities as c')
            ->join('states as s', 's.id', '=', 'c.state_id')
            ->where('s.name', '=', $state)
            ->select('c.name')
            ->lists('c.name', 'c.name');

        return $cities;
    }

    /**
     * Get latitude and longitude from address and zip code
     *
     * @param $address
     * @param $zip_code
     * @return array
     */
    public static function getGeocode($address, $zip_code)
    {
        $apiKey = config('constants.api-key');
        $address = str_replace(" ", "+", $address);
        $jsonResponse = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&components=country:IN|postal_code:$zip_code&key=$apiKey");
        $geoCode = json_decode($jsonResponse);
        return array('latitude' => $geoCode->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}, 'longitude' => $geoCode->{'results'}[0]->{'geometry'}->{'location'}->{'lng'});
    }
}