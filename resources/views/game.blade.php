@extends('frontend.layouts.master')

@section('body')
<div class="container mb-5">
    @if(session()->has('message'))
    <div class="alert alert-danger fade in alert-dismiss show">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size:20px">x</span>
    </div>
    @endif
    @if(session()->has('message_sent'))
    <div class="alert alert-success fade in alert-dismiss show">
        {{ session()->get('message_sent') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size:20px">x</span>
    </div>
    @endif
    <div class="card mt-5  border-primary">
        <div class="card-header">
            <h1>Game Information</h1>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-6">
                    <h1>{{$game->game_name}} 
                    @if(Auth::check())
                    @if(auth()->user()->role=='admin')
                        <a class="btn btn-danger mr-1 mb-2 btn-sm" href="{{route('admin.delete',$game->id)}}">Delete Game <i class="far fa-trash-alt"></i></a>
                        @endif
                        @endif
                    </h1>

                    <hr class="my-2">
                    <h5>Game Developer: {{$game->game_developer}}</h5>
                    <h5>Game Description: {{$game->game_description}}</h5>
                    <h5>Game Genre: {{$game->genre_id}}</h5>
                    <h5>Console: {{$game->console->console_name}}</h5>
                    <h5>Game Price: Rs {{$game->game_price}}</h5>
                    <h5>Listed By: {{$game->user->name}}</h5>
                    <h5>Comment: {{$game->game_comment}}</h5>
                    <div class="mt-5">
                    @if(Auth::check())
                    @if(auth()->user()->role!='admin')
                        <a class="btn btn-primary mr-1" href="{{route('offer.Form', $game->id)}}">Send Offer <i class="far fa-money-bill-alt"></i></a>
                    @endif
                    @endif
                    </div>
                </div>
                <div class="col-6 p-5">

                    <div class="text-center">

                        <img src="{{asset('uploads/game/'. $game->game_image)}}" class="ml-5" height="255" alt="Game Image">
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">

                            @if(Auth::check())
                            <hr class="my-4">
                            @if(auth()->user()->role!='admin')
                            @if(auth()->user()->id!=$game->user->id)
                            <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#status">Report Game <i class="far fa-flag"></i></a>
                            @endif
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade mt-5" id="status" tabindex="-1" aria-labelledby="status" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="ml-4">
                <form action="{{route('user.report', $game->id)}}" method="post">
                    @csrf
                    <div class="form-group ">
                        <label for="game_name" class="col-sm-2 col-form-label">Game</label>
                        <div class="col-sm-11">
                            <input type="Text" class="form-control" id="game_name" placeholder="game name" value="{{$game->game_name}}" name="game_name" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="user" class="col-sm-3 col-form-label">Added By</label>
                        <div class="col-sm-11">
                            <input type="Text" class="form-control" id="game_user" placeholder="game user" value="{{$game->user->name}}" name="game_user" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="report" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-11">
                            <select class="form-control " id="Report_reason" name="report_reason">
                                <option value="Inappropriate Content">Inappropriate Content</option>
                                <option value="Fake or Spam">Fake or Spam</option>
                                <option value="Duplicate Content">Duplicate Content</option>
                                <option value="No longer Available">No longer Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-11 col-form-label">Comment (Describe why you want to report the game)</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" id="report_comment" name="report_comment" placeholder="Enter the reason you reported the game" rows="4">{{old('report_comment')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger mb-5 ml-3">Report</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection

@push('styles')
<style>

</style>
@endpush