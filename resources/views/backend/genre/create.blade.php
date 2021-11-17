@extends('backend.layouts.master')

@section('body')

<div class="row">
    <div class=col-1></div>
    <div class="col-10">
        <div class="card border-secondary  mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>Add a New Genre</h2>
            </div>
            <div class="p-3">
                <form action="{{route('admin.genre.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Genre Name:</label>
                        <input type="text" class="form-control" id="genre_name" value="{{old('genre_name')}}" placeholder="Enter Genre's Name" name="genre_name">
                        <span style="color:red"> @error ('genre_name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Genre Description:</label>
                        <textarea class="form-control" id="genre_description" name="genre_description" placeholder="Enter Genre's Description" rows="4">{{old('genre_description')}}</textarea>
                        <span style="color:red"> @error ('genre_description'){{$message}}@enderror</span>
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

@endpush
@push('scripts')

@endpush