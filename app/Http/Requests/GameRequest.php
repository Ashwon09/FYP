<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GameRequest extends FormRequest
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
            'console_id' => 'required',
            'game_name' => 'required|max:50|',
            'game_description' => 'required|max:50',
            'game_description' => 'required|max:1000',
            'game_price' => 'required',
            'genre_id' => 'required',
            'game_comment' => 'max:1000',
            'game_image' => 'image|mimes:jpg,png,jpeg',
            //
            //
        ];
    }

    public function createItem()
    {

        $genre = implode(',', $this->genre_id);
        // dd($genre);
        $newImageName = null;
        if ($this->game_image != null) {
            $file = $this->file('game_image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('/uploads/game');
            $this->file('game_image')->move($dest, $newImageName);
        }
        return [
            'game_name' => $this->game_name,
            'game_developer' => $this->game_developer,
            'game_description' => $this->game_description,
            'game_price' => $this->game_price,
            'game_image' => $newImageName,
            'game_comment' => $this->game_comment,
            'genre_id' => $genre,
            'console_id' => $this->console_id,
            'user_id' => Auth::user()->id,
        ];
    }
}
