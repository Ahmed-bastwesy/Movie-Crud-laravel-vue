<?php

namespace App\Http\Requests\Movie;

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
        return [
                'title'       => ['required', 'string', 'min:3',"unique:categories,title," .$this->route('category')?->id],
                'description' => ['required', 'string', 'min:3'],
                'rate'        => ['required', 'numeric', "regex:/^(?:[1-9]\d*|0)?(?:\.\d+)?$/m"],
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'category_id' => ['required','exists:categories,id']
        ];

    }
}
