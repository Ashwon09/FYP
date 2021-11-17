@extends('backend.layouts.master')


@section('body')
<div class="m-3">
    <div class="text-center mt-3">
        <h1 class="font-weight-bold">View Genres</h1>
    </div>
    <div class="text-right mr-3 mb-2">
        <a class="btn btn-primary" href="{{route('admin.genre.create')}}"> Add genre<i class="fas fa-plus-circle ml-1"></i></a>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="genres">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Genre Name</th>
                    <th>Genre Description</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($genres as $genre)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$genre->genre_name}}</td>
                    <td>{{$genre->genre_description}}</td>

                    <td>
                        <a type="button" class="btn btn-danger" href="{{route('admin.genre.delete', $genre->id)}}">Delete <i class="far fa-trash-alt"></i></a>
                        <a type="button" class="btn btn-primary" href="{{route('admin.genre.edit', $genre->id)}}">Edit <i class="far fa-edit"></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')

@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        $('#genres').DataTable();
    });
</script>
@endpush