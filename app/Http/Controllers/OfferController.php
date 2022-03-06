<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashOfferRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CashOffer;

class OfferController extends Controller
{
    //
    public function __construct(Game $game){
        $this->game=$game;
    }
    
    public function cashOfferForm($id){
        $game=$this->game::find($id);
        return view('frontend.offer',compact('game'));
    }

    public function cashOffer(CashOfferRequest $request, $id){
        $game=$this->game::find($id);
        $data=[
            'email'=>$request->email,
            'offer'=>$request->offer,
            'comment'=>$request->comment,
            'phone'=>Auth::user()->phone_number,
            'offer_from'=>Auth::user()->name,
            'game'=>$game->game_name,
            'console'=>$game->console->console_name,
        ];
        // dd($game->user->email);
        Mail::to($game->user->email)->send(new CashOffer($data));
        return view('game',compact('game'));
        
    }

}
