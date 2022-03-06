@extends('frontend.layouts.master')

@section('body')
<div class="container mb-5">
    <div class="card mt-5">
        <div class="card-header">
            <h1>Send Cash Offer for {{$game->game_name}}</h1>
        </div>
        <div class="card-body">
            <form action="{{route('offer.cash',$game->id)}}" method="get">
                <div class="form-group">
                    <label for="email">Your Email address</label>
                    <input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" name="email" readonly>
                    <span style="color:red"> @error ('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="Offer">Select Offer</label>
                    <select class="form-control" id="manufacturer_id" name="manufacturer_id">
                        <option disabled selected>Select Offer</option>
                        <option value="cash offer">Cash Offer</option>
                        <option value="cash offer">Exchange Offer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" value="{{old('price')}}" name="price" >
                    <span style="color:red"> @error ('email'){{$message}}@enderror</span>
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