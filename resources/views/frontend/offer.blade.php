@extends('frontend.layouts.master')

@section('body')
<div class="container mb-5">
    <div class="card mt-5">
        <div class="card-header">
            <h1>Send Offer for {{$game->game_name}}</h1>
            <h3>Added By {{$game->user->name}}</h3>
        </div>
        <div class="card-body">
            <form action="{{route('offer.offer',$game->id)}}" method="get">
                <div class="form-group">
                    <label for="game">Offer for</label>
                    <input type="text" class="form-control" id="game" value="{{$game->game_name}}" name="game" readonly>
                    <span style="color:red"> @error ('game'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="Offer">Select Type of Offer</label>
                    <select class="form-control" id="offer_type" name="offer_type">
                        <option disabled selected>Select Offer</option>
                        <option value="Cash offer">Cash </option>
                        <option value="Exchange offer">Exchange </option>
                    </select>
                    <span style="color:red"> @error ('offer_type'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="offer">Offer</label>
                    <input type="text" class="form-control" id="offer" value="{{old('offer')}}" placeholder="Enter Price if Cash else enter Game name" name="offer" >
                    <span style="color:red"> @error ('offer'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Enter Comment" rows="4">{{old('comment')}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

</style>
@endpush