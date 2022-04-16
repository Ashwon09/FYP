@extends('user.layouts.master')

@section('body')


<div class="m-3">
    <div class="text-center mt-3">
        @if(session()->has('message'))
        <div class="alert alert-success fade in alert-dismiss show">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">x</span>
        </div>
        @endif
        <h1 class="font-weight-bold">Offer Sent</h1>
    </div>
    <div class="dropdown show text-right mb-5">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            List Offers
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('offer.offerSentAccept')}}">Accepted</a>
            <a class="dropdown-item" href="{{route('offer.offerSentReject')}}">Rejected</a>
            <a class="dropdown-item" href="{{route('offer.offerSentPending')}}">Pending</a>
        </div>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="items">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Game Name</th>
                    <th>Offer to</th>
                    <th>Offer Type</th>
                    <th>Offer</th>
                    <th>Game Image</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach ($offers as $offer)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$offer->game->game_name}}</td>
                    <td>{{$offer->game->user->name}}</td>
                    <td>{{$offer->offer_type}}</td>
                    <td>{{$offer->offer}}</td>
                    <td><img src="{{asset('uploads/game/'. $offer->game->game_image)}}" alt="" width='100' height='100'></td>
                    @if($offer->status=='accepted')
                    <td>
                        {{$offer->game->user->phone_number}}
                    </td>
                    @else
                    <td>
        
                    </td>
                    @endif
                    <td>{{$offer->status}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#items').DataTable();
    });
</script>
@endpush