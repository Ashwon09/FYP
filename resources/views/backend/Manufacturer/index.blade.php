@extends('backend.layouts.master')


@section('body')
<div class="container-fluid">
    <div class="text-center">
        <h1 class="font-weight-bold">View Manufacturers</h1>
    </div>
    <div class="text-right mr-3 mb-2">
        <a class="btn btn-primary" href="{{route('admin.manufacturer.create')}}"> Add Manufacturer<i class="fas fa-plus-circle ml-1"></i></a>
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="manufacturers">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Manufacturer Name</th>
                    <th>Manufacturer Description</th>
                    <th>Manufacturer Image</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($manufacturers as $manufacturer)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$manufacturer->manufacturer_name}}</td>
                    <td>{{$manufacturer->manufacturer_description}}</td>
                    <td class="text-center"> <img src="{{asset('uploads/manufacturer/'. $manufacturer->manufacturer_image)}}" alt="" width='100' height='100'> </td>

                    <td>
                        <a type="button" class="btn btn-danger" href="{{route('admin.manufacturer.delete',$manufacturer->id)}}">Delete <i class="far fa-trash-alt"></i></a>
                        <a type="button" class="btn btn-primary" href="{{route('admin.manufacturer.edit',$manufacturer->id)}}">Edit <i class="far fa-edit"></i></a>
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
        $('#manufacturers').DataTable();
    });
</script>
@endpush