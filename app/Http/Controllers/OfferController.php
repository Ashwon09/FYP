<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CashOffer;
use App\Models\Offer;

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

    public function Offer(OfferRequest $request, $id){
        $game=$this->game::find($id);

        // dd($game->user->id);
        
        $data=[
            'game'=>$request->game,
            'user'=>Auth::user()->name,
            'offer_type'=>$request->offer_type,
            'offer'=>$request->offer,
            'phone'=>Auth::user()->phone_number,
        ];
        // dd($game->user->email);
        Mail::to($game->user->email)->send(new CashOffer($data));
        // dd($request->all());
        Offer::create([
            'user_id'=> Auth::user()->id,
            'game_id' => $game->id,
            'offer_type' => $request->offer_type,
            'offer' =>$request->offer,
            'comment' => $request->comment,
            'offer_to'=>$game->user->id,
        ]);
        return view('game')->with('message_sent', 'Offer Sent')->with('game',$game);
        
    }

    public function offerReceived(){
        $offers= Offer::orderBy('created_at', 'asc')->where('offer_to',Auth::user()->id)->where('status','pending')->get();
        // dd($offers);
        return view('user.offerreceived', compact('offers'));
    }

    public function offerSent(){
        $offers= Offer::orderBy('created_at', 'asc')->where('user_id',Auth::user()->id)->where('status','pending')->get();
        // dd($offers);
        return view('user.offersent', compact('offers'));
    }

}
