<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Manufacturer;
use App\Models\Console;
use Illuminate\Http\Request;

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
}
