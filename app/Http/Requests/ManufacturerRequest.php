<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
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
            'manufacturer_name' => 'required|max:15|',
            'manufacturer_description' => 'max:50',
            'manufacturer_image' => 'mimes:jpg,png,jpeg',
            //
        ];
    }
    public function createBrand()
    {
        $newImageName = null;
        if ($this->game_image != null) {
            $file = $this->file('manufacturer_image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('/uploads/manufacturer');
            $this->file('manufacturer_image')->move($dest, $newImageName);
        }
        return [
            'manufacturer_name' => $this->manufacturer_name,
            'manufacturer_description' => $this->manufacturer_description,
            'manufacturer_image' => $newImageName,
        ];
    }
}
