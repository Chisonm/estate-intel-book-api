<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "isbn" => "required|string|max:255",
            "authors" => "required|string|max:255",
            "publisher" => "required|string|max:255",
            "country" => "required|string|max:255",
            "number_of_pages" => "required|integer",
            "released_date" => "required|date",
        ];
    }
}