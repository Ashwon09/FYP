<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'genre_name'=>'required',
            'genre_description'=>'required|max:1000|min:30'

            //
        ];
    }

    public function createGenre(){
        return[
            'genre_name'=>$this->genre_name,
            'genre_description'=>$this->genre_description,
        ];
    }
}
