@extends('backend.layouts.master')


@section('body')
<div class="container-fluid">
    <div class="text-center">
        <h1 class="font-weight-bold">View Reports</h1>
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
                    <th>Report Times</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($reports as $report)
                <tr>
                    <td> {{$i++ }}</td>
                    <td>{{$report->user->id}}</td>
                    <td>{{$report->user->name}}</td>
                    <td>{{$report->user->phone_number}}</td>
                    <td>{{$report->report_times}}</td>
                    <td>
                        @if($report->user->role!='banned')
                        <a type="button" class="btn btn-primary" href="{{route('admin.banUser',$report->user->id)}}">Ban User</a>
                        @else
                        <p class="text-danger"> 
                        User is banned
                        <p>
                        @endif
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