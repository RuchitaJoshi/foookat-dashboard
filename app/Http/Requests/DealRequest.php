<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DealRequest extends Request
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
        if(!empty($this->segment(9)))
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'details' => 'required|min:2|max:255',
                'original_price' => 'required|numeric|min:0',
                'discount_type' => 'required',
                'percentage_off' => 'numeric|min:1|required_if:discount_type,Percentage Off',
                'amount_off' => 'numeric|min:1|required_if:discount_type,Amount Off',
                'new_price' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'deal_days' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'redeem_code' => 'required|max:8',
                'category' => 'required',
                'overview' => 'required',
            ];
        }
        else
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'details' => 'required|min:2|max:255',
                'original_price' => 'required|numeric|min:0',
                'discount_type' => 'required',
                'percentage_off' => 'numeric|min:1|required_if:discount_type,Percentage Off',
                'amount_off' => 'numeric|min:1|required_if:discount_type,Amount Off',
                'new_price' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'deal_days' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'redeem_code' => 'required|max:8',
                'category' => 'required',
                'overview' => 'required',
            ];
        }

        return $rules;
    }
}
