<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Console;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Game $game, Console $console, Genre $genre)
    {
        $this->game = $game;
        $this->genre = $genre;
        $this->console = $console;
    }

    public function index()
    {
        $games = $this->game::where('user_id', Auth::user()->id)->get();
        // dd($games);
        return view('user.games.index', compact('games'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = $this->genre::orderBy('created_at', 'asc')->get();
        $consoles = $this->console::orderBy('created_at', 'asc')->get();
        return view('user.games.create', compact('genres', 'consoles'));

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        // dd($request->all());

        if ($this->checkGame($request->game_description)) {
            if (!is_dir('uploads'))
                mkdir('uploads');

            if (!is_dir('uploads/game'))
                mkdir('uploads/game');

            $this->game::create($request->createItem());

            return redirect()->route('user.game.index')->with('message', 'Game Successfully Added');
        } else {
            return redirect()->route('user.game.create')->with('message', 'Enter Valid Game with Game Description');
        }


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genres = $this->genre::orderBy('created_at', 'asc')->get();
        $consoles = $this->console::orderBy('created_at', 'asc')->get();
        $game = $this->game::find($id);
        // dd($game);
        $game_genre = $game->genre_id;
        $game_genres = explode(',', $game_genre);
        // dd($game_genres);
        return view('user.games.edit', compact('game', 'game_genres', 'genres', 'consoles'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, $id)
    {
        $game = $this->game::find($id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = $this->game::find($id);
        $destination = public_path('uploads/game/' . $game->game_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $game->delete();
        return redirect()->back();
        //
    }

    public function checkGame($description)
    {
        $description = explode(' ', $description);
        // dd($description);
        foreach ($description as $desc) {
            if (
                (strcmp(strtolower($desc), 'games') == 0
                    || strcmp(strtolower($desc), 'game') == 0)
                && (strcmp(strtolower($desc), 'multiplayer') == 0
                    || strcmp(strtolower($desc), 'player') == 0
                    || strcmp(strtolower($desc), 'online') == 0
                    || strcmp(strtolower($desc), 'free') == 0
                    || strcmp(strtolower($desc), 'sports') == 0
                    || strcmp(strtolower($desc), 'strategy') == 0
                    || strcmp(strtolower($desc), 'rpg') == 0
                    || strcmp(strtolower($desc), 'mmo') == 0
                    || strcmp(strtolower($desc), 'action') == 0
                    || strcmp(strtolower($desc), 'fps') == 0
                    || strcmp(strtolower($desc), 'adventure') == 0
                    || strcmp(strtolower($desc), 'battle') == 0
                    || strcmp(strtolower($desc), 'fighting') == 0
                    || strcmp(strtolower($desc), 'racing') == 0
                    || strcmp(strtolower($desc), 'shooting') == 0
                    || strcmp(strtolower($desc), 'pve') == 0
                    || strcmp(strtolower($desc), 'pvp') == 0
                    || strcmp(strtolower($desc), 'players') == 0)
            ) {
                return true;
            }
        }
        return false;
    }
}
