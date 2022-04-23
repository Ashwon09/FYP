@extends('backend.layouts.master')


@section('body')
<div class="container-fluid">
    <div class="text-center">
        <h1 class="font-weight-bold">View Banned Users</h1>
    </div>
    <div class="text-right mr-3 mb-2">
    </div>
    <div class="table-responsive-md">
        <table class="table table-bordered" id="manufacturers">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>Contact Number</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($users as $user)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>
                        <a type="button" class="btn btn-primary" href="{{route('admin.unBanUser',$user->id)}}">Unban User</a>
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