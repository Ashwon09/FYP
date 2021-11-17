@extends('frontend.layouts.master')

@section('body')
<div class="container mb-5">
    <div class="card mt-5  border-primary">
        <div class="card-header">
            <h1>Game Information</h1>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-6">
                    <h1>{{$game->game_name}}</h1>
                    <hr class="my-2">
                    <h5>Game Developer: {{$game->game_developer}}</h5>
                    <h5>Game Description: {{$game->game_description}}</h5>
                    <h5>Game Genre: {{$game->genre_id}}</h5>
                    <h5>Console: {{$game->console->console_name}}</h5>
                    <h5>Game Price: Rs {{$game->game_price}}</h5>
                    <h5>Listed By: {{$game->user->name}}</h5>
                    <h5>Comment: {{$game->game_comment}}</h5>
                    <div class="mt-5">
                        <a class="btn btn-primary mr-1" href="{{route('offer.cashForm', $game->id)}}">Send Cash Offer <i class="far fa-money-bill-alt"></i></a>
                        <a class="btn btn-primary mr-1" href="{{route('offer.exchangeForm', $game->id)}}">Send Exchange Offer <i class="fas fa-exchange-alt"></i></a>
                        <a class="btn btn-primary mr-1" href="{{route('offer.questionForm', $game->id)}}">Ask Question <i class="far fa-question-circle"></i></a>
                    </div>
                </div>
                <div class="col-6 p-5">
                    <img src="{{asset('uploads/game/'. $game->game_image)}}" class="ml-5" height="255" alt="Game Image">
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

</style>
@endpush