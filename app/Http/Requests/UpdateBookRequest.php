<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
//        }
        return [
            'title'=>'required|max:255',
            'authors'=>'required|max:255',
            'released_at'=>'required|date|before:now',
            'pages'=>'required|integer|min:1',
            'isbn'=>'required|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',Rule::unique('books')->ignore($this->id),
            'description'=>'nullable',
            'genres' => 'nullable | array',
            'cover_image'=>'nullable|url',
            'in_stock'=>'required|integer|min:0'
        ];
    }
}
