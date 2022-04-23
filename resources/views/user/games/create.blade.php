@extends('user.layouts.master')

@section('body')

<div class="row">
    <div class=col-1></div>
    <div class="col-10">
    @if(session()->has('message'))
        <div class="alert alert-danger fade in alert-dismiss show">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">x</span>
        </div>
        @endif
        <div class="card border-secondary mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>List a New Items</h2>
            </div>
            <div class="p-3">
                <form action="{{route('user.game.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Game Name:</label>
                        <input type="text" class="form-control" id="game_name" value="{{old('game_name')}}" placeholder="Enter Game's Name" name="game_name">
                        <span style="color:red"> @error ('game_name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Game Developer:</label>
                        <input type="text" class="form-control" id="game_developer" value="{{old('game_developer')}}" placeholder="Enter Game's Developer" name="game_developer">
                        <span style="color:red"> @error ('game_developer'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Game Description:</label>
                        <textarea class="form-control" id="game_description" name="game_description" placeholder="Enter Game's Description" rows="4">{{old('game_description')}}</textarea>
                        <span style="color:red"> @error ('game_description'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Game Price:</label>
                        <input type="number" class="form-control" id="game_price" value="{{old('game_price')}}" placeholder="Enter Game's Price" name="game_price">
                        <span style="color:red"> @error ('game_price'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Genre:</label>
                        <select class="form-control mult" id="genre_id" name="genre_id[]" multiple='multiple'>
                            <option disabled>Select Genre</option>
                            @foreach($genres as $genre)
                            <option value="{{$genre->genre_name}}">{{$genre->genre_name}}</option>
                            @endforeach
                        </select>
                        <span style="color:red"> @error ('genre_id'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Console:</label>
                        <select class="form-control" id="console_id" name="console_id">
                            <option disabled selected>Select Console</option>
                            @foreach($consoles as $console)
                            <option value="{{$console->id}}">{{$console->console_name}}</option>
                            @endforeach
                        </select>
                        <span style="color:red"> @error ('console_id'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Game Comment:</label>
                        <textarea class="form-control" id="game_comment" name="game_comment" placeholder="Enter Comment" rows="4">{{old('game_comment')}}</textarea>
                        <span style="color:red"> @error ('game_comment'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="image">Game's Image:</label>
                        <input type="file" name="game_image" class="form-control" id="image_input">
                        <span style="color:red"> @error ('game_image'){{$message}}@enderror</span>
                    </div>
                    <div class="image-holder">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.mult').select2();
    });
    $(function() {
        $('#image_input').on('change', function() {
            let image_path = $(this)[0].value;
            var image_holder = $('.image-holder');
            var extension = image_path.substring(image_path.lastIndexOf('.') + 1).toLowerCase();

            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png' || extension == 'jfif') {
                if (typeof(FileReader) != 'undefined') {
                    image_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:100px;margin-bottom:10px;'
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(image_holder).html('This browser does not support fileReader');
                }

            } else {
                $(image_holder).empty();
            }
        });
    });
</script>

@endpush