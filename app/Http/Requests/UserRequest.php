<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Request;

class UserRequest extends Request
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
        if(!empty($this->segment(3)))
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$this->segment(3),
            ];
        }
        else
        {
            $rules = [
                'name' => 'required|min:2|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:8'
            ];
        }
        return $rules;
    }
}
