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
                    <th>Report By</th>
                    <th>Report To</th>
                    <th>Report Game</th>
                    <th>Report Reason</th>
                    <th>Report Comment</th>
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
                    <td>{{$report->user->name}}</td>
                    <td>{{$report->game->user->name}}</td>
                    <td>{{$report->game->game_name}}</td>
                    <td>{{$report->report_reason}}</td>
                    <td>{{$report->report_comment}}</td>
                    <td>
                        <a type="button" class="btn btn-danger" href="">Delete Report <i class="far fa-trash-alt"></i></a>
                        <a type="button" class="btn btn-primary" href="{{route('selectedGame', $report->game->id)}}">View Game <i class="far fa-edit"></i></a>
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