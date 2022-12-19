<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
                'name' => ['required', 'string', 'min:3'],
                'email' =>'required|email|unique:users,email,' . $this->user?->id,
                'password' => ['required', 'string','confirmed'],
                'birthdate' => ['required'],
        ];
        if(request('type')=="Providers"){
            $rules['roles']=['required','exists:roles,id'];
        }
        if (request()->isMethod('PUT')) {
            $rules['password'] = ['nullable', 'confirmed'];
        }
        return $rules;
    }
}
