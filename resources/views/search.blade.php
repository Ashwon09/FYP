@foreach ($games as $game)
                <div class="col-md-3 mt-4">
                    <a class="link" href="{{route('selectedGame', $game->id)}}">
                        <div class="card border-primary cust-card ">
                            <div class="card-img-top text-center ">
                                <img src="{{asset('uploads/game/'. $game->game_image)}}" class="m-1" height="155" width="135" alt="image">
                            </div>
                            <div class="card-body p-0">
                                <h3 class="text-center">{{$game->game_name}}</h3>
                                <table class="table table-sm table-borderless ml-3">
                                    <tr>
                                        <td class="font-weight-bold">Genre :</td>
                                        <td>{{$game->genre_id}} </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Price :</td>
                                        <td> NPR {{$game->game_price}} </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </a>
                </div>
                @endforeach