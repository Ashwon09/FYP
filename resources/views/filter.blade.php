<div class="card mt-5 ml-3">
                <div class="card-header">Filter Options</div>
                <div class="card-body">
                    <form action="{{route('filter')}}">
                        <div class="form-group">
                            <label for="price">Price:</label>
                            Min: <input type="number" class="form-control" placeholder="Enter Minimum Price" id="min_price" name="min_price">
                            Max: <input type="number" class="form-control" placeholder="Enter Maximum Price" id="max_price" name="max_price">
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <select class="form-control mult" id="genre_id" name="genre_id">
                                <option disabled selected>Select Genre</option>
                                @foreach($genres as $genre)
                                <option value="{{$genre->genre_name}}">{{$genre->genre_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="console">Console</label>
                            <select class="form-control" id="console_id" name="console_id">
                                <option disabled selected>Select Console</option>
                                @foreach($consoles as $console)
                                <option value="{{$console->id}}">{{$console->console_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sortBy">SortBy</label>
                            <select class="form-control" id="sortBy" name="sortBy">
                                <option value="game_price desc">Price (High to Low)</option>
                                <option value="game_price asc">Price (Low to High)</option>
                                <option value="created_at asc">Created (Old to New)</option>
                                <option value="created_at desc" selected>Created (New to Old)</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>