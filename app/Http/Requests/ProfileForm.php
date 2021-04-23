<?php

namespace App\Http\Requests;

use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ];
    }

    public function persist()
    {
        $completeAddress = $this->address . " " .  $this->state . " " .  $this->zip;

        Profile::create([
            'user_id' => Auth::user()->id,
            'name' =>  $this->name,
            'phone' =>  $this->phone,
            'address' => $completeAddress,
        ]);
    }
}
