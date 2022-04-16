<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $priceSort = 'desc';
    public $NameSort = 'desc';

    public function __construct(Game $game, Genre $genre, Console $console)
    {
        $this->game = $game;
        $this->genre = $genre;
        $this->console = $console;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $games = $this->game::orderBy('created_at', 'desc')->paginate(4);
        // dd($games);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        return view('home', compact('games', 'genres', 'consoles'));
    }

    //to return view of different users
    public function returnView()
    {
        if (Auth::check()) {
            if (Auth::User()->role == 'customer') {
                return redirect()->route('user.details');
            } elseif (Auth::User()->role == 'admin') {
                return redirect()->route('admin.index');
            }
            elseif (Auth::User()->role == 'banned') {
                return redirect()->route('bannedView');
            }
        } else {
            return redirect()->route('home');
        }
    }


    // for search function
    public function search(Request $request)
    {
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        $search = $request->search;
        // dd($search);
        $count = count($this->game::orderBy('created_at', 'desc')->where('game_name', 'LIKE', '%' . $search . '%')->get());
        $games = $this->game::orderBy('created_at', 'desc')->where('game_name', 'LIKE', '%' . $search . '%')->paginate(3);
        return view('home', compact('games', 'count', 'genres', 'consoles', 'search'));
    }


    // for filter function
    public function filter(Request $request)
    {
        $sort = explode(' ', $request->sortBy);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        $games = $this->game::orderBy($sort[0] , $sort[1])
        ->where(function ($query) use ($request) {
            if (!empty($request->console_id)) {
                $query->where('console_id',  $request->console_id);
            }
            if (!empty($request->max_price)) {
                $query->where('game_price', '<=',  $request->max_price);
            }
            if (!empty($request->min_price)) {
                $query->where('game_price', '>=',  $request->min_price);
            }
            if (!empty($request->genre_id)) {
                $query->where('genre_id', 'LIKE', '%' . $request->genre_id . '%');
            }
            if (!empty($request->sortBy)) {
            } else {
                $query->orderBy('created_at', 'desc');
            }
            return $query;
        })
            ->paginate(2);
        $count = -1;
        // dd($data);
        return view('home', compact('genres', 'consoles', 'games', 'count'));
    }

    //to view games page 
    public function viewGame($id)
    {
        $game = $this->game::find($id);
        // dd($game);
        return view('game', compact('game'));
    }

    //to sorting
    public function sortByPriceasc()
    {
        $games = $this->game::orderBy('game_price', 'asc')->paginate(4);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        return view('home', compact('games', 'genres', 'consoles'));
    }
    public function sortByPricedesc()
    {
        $games = $this->game::orderBy('game_price', 'desc')->paginate(4);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        return view('home', compact('games', 'genres', 'consoles'));
    }

    public function sortByCreatedasc()
    {
        $games = $this->game::orderBy('created_at', 'asc')->paginate(4);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        return view('home', compact('games', 'genres', 'consoles'));
    }

    public function sortByCreateddesc()
    {
        $games = $this->game::orderBy('created_at', 'desc')->paginate(4);
        $genres = $this->genre::get();
        $consoles = $this->console::get();
        return view('home', compact('games', 'genres', 'consoles'));
    }

    public function bannedView(){
        return view('banned');
    }
}
