<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Manufacturer;
use App\Models\Console;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function __construct(Manufacturer $manufacturer, Game $games, Console $console)
    {
        $this->manufacturer=$manufacturer;
        $this->game=$games;
        $this->console=$console;
    }

    public function index()
    {
        $manufacturers= $this->manufacturer::get();
        $consoles= $this->console::get();
        $games= $this->game::get();
        return view('backend.index', compact('manufacturers','consoles','games'));
    }

    public function destroy($id)
    {
        $game = $this->game::find($id);
        $destination = public_path('uploads/game/' . $game->game_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $game->delete();
        return redirect()->route('admin.reportIndex');
        //
    }



}
