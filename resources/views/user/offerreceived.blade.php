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
        <h1 class="font-weight-bold">Offer Received</h1>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="items">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Game Name</th>
                    <th>Offer from</th>
                    <th>Offer Type</th>
                    <th>Offer</th>
                    <th>Game Image</th>
                    <th>Action</th>
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
                    <td>{{$offer->user->name}}</td>
                    <td>{{$offer->offer_type}}</td>
                    <td>{{$offer->offer}}</td>
                    <td><img src="{{asset('uploads/game/'. $offer->game->game_image)}}" alt="" width='100' height='100'></td>
                    <td>
                        <a type="button" class="btn btn-danger" href="">Reject <i class="fas fa-times"></i></a>
                        <a type="button" class="btn btn-success" href="">Accept <i class="fas fa-check"></i></a>
                    </td>
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