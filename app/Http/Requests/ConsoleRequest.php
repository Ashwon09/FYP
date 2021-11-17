<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsoleRequest extends FormRequest
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
            'console_name' => 'required|max:15|',
            'console_description' => 'max:50',
            'manufacturer_id' => 'required',


            //
        ];
    }
    public function createconsole(){
        return[
            'console_name' => $this->console_name,
            'console_description' => $this->console_description,
            'manufacturer_id' => $this->manufacturer_id,
        ];
    }
}
