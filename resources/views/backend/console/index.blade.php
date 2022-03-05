@extends('backend.layouts.master')


@section('body')
<div class="m-3">
    <div class="text-center mt-3">
        <h1 class="font-weight-bold">View Consoles</h1>
    </div>
    <div class="text-right mr-3 mb-2">
        <a class="btn btn-primary" href="{{route('admin.console.create')}}"> Add Console<i class="fas fa-plus-circle ml-1"></i></a>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="consoles">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Console Name</th>
                    <th>Console Manufacturer</th>
                    <th>Console Description</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($consoles as $console)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$console->console_name}}</td>
                    <td>{{$console->manufacturer->manufacturer_name}}</td>
                    <td>{{$console->console_description}}</td>

                    <td>
                        <!-- <a type="button" class="btn btn-danger" href="{{route('admin.console.delete', $console->id)}}">Delete <i class="far fa-trash-alt"></i></a> -->
                        <a type="button" class="btn btn-primary" href="{{route('admin.console.edit', $console->id)}}">Edit <i class="far fa-edit"></i></a>
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
        $('#consoles').DataTable();
    });
</script>
@endpush