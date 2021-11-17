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
        <h1 class="font-weight-bold">View Listed Games</h1>
    </div>
    <div class="text-right mr-3 mb-2">
        <a class="btn btn-primary" href="{{route('user.game.create')}}">List New Game<i class="fas fa-plus-circle ml-1"></i></a>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="items">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Game Name</th>
                    <th>Game Developer</th>
                    <th>Game Price</th>
                    <th>Game Console</th>
                    <th>Game Image</th>
                    <th>Game Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach ($games as $game)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$game->game_name}}</td>
                    <td>{{$game->game_developer}}</td>
                    <td>{{$game->game_price}}</td>
                    <td>{{$game->console->console_name}}</td>
                    <td><img src="{{asset('uploads/game/'. $game->game_image)}}" alt="" width='100' height='100'></td>
                    <td>{{$game->game_status}}</td>
                    <td>
                        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#status{{$game->id}}">Info <i class="fas fa-info"></i></a>
                        <a type="button" class="btn btn-primary" href="{{route('user.game.edit', $game->id)}}">Edit <i class="far fa-edit"></i></a>
                        <a type="button" class="btn btn-danger" href="{{route('user.game.delete',$game->id)}}">Delete <i class="far fa-trash-alt"></i></a>
                        <a type="button" class="btn btn-warning text-white" href="">Sold <i class="fas fa-dollar-sign"></i></a>
                    </td>
                </tr>


                <div class="modal fade" id="status{{$game->id}}" tabindex="-1" aria-labelledby="status" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Game Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="ml-5">
                                <h6>Game Name</h6>

                                <p>{{$game->game_name}}

                                    <img class="ml-5" src="{{asset('uploads/game/'. $game->game_image)}}" alt="" width='80' height='100'>
                                </p>


                                <h6>Game Developer</h6>
                                <p>{{$game->game_developer}}</p>

                                <h6>Game Description</h6>
                                <p>{{$game->game_description}}</p>

                                <h6>Game Genre</h6>
                                <p>{{$game->genre_id}}</p>

                                <h6>Game Price</h6>
                                <p>{{$game->game_price}}</p>


                                <h6>Game Comment</h6>
                                <p>{{$game->game_comment}}</p>

                                <h6>Game Status</h6>
                                <p>{{$game->game_status}}</p>

                                <h6>Game Console</h6>
                                <p>{{$game->console->console_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
@push('styles')
<style>
    h6 {
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#items').DataTable();
    });
</script>
@endpush