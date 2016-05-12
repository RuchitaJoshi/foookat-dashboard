<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function forbiddenResponse()
    {
        return Response::view('errors.403');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(!empty($this->segment(7)))
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'overview' => 'required|min:2|max:255',
                'league' => 'required',
                'mobile_number' => 'required',
                'phone_number' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'mon_open' => 'required',
                'mon_close' => 'required',
                'tue_open' => 'required',
                'tue_close' => 'required',
                'wed_open' => 'required',
                'wed_close' => 'required',
                'thu_open' => 'required',
                'thu_close' => 'required',
                'fri_open' => 'required',
                'fri_close' => 'required',
                'sat_open' => 'required',
                'sat_close' => 'required',
                'sun_open' => 'required',
                'sun_close' => 'required'
            ];
        }
        else
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'overview' => 'required|min:2|max:255',
                'league' => 'required',
                'mobile_number' => 'required',
                'phone_number' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'zip_code' => 'required',
                'mon_open' => 'required',
                'mon_close' => 'required',
                'tue_open' => 'required',
                'tue_close' => 'required',
                'wed_open' => 'required',
                'wed_close' => 'required',
                'thu_open' => 'required',
                'thu_close' => 'required',
                'fri_open' => 'required',
                'fri_close' => 'required',
                'sat_open' => 'required',
                'sat_close' => 'required',
                'sun_open' => 'required',
                'sun_close' => 'required'
            ];
        }

        return $rules;
    }
}
