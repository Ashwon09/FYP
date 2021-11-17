@extends('frontend.layouts.master')

@section('body')
<div class="container mb-5">
    <div class="card mt-5">
        <div class="card-header">
            <h1>Send Exchanged Offer for {{$game->game_name}}</h1>
        </div>
        <div class="card-body">
            <form action="{{route('offer.exchange',$game->id)}}" method="get">
                <div class="form-group">
                    <label for="email">Your Email address</label>
                    <input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" name="email" readonly>
                    <span style="color:red"> @error ('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="Offer">Exchange game with</label>
                    <input type="text" class="form-control" id="offer" value="{{old('offer')}}" placeholder="Enter Game Name You Want To Exchange" name="offer">
                    <span style="color:red"> @error ('offer'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="comment">Add Comment</label>
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