@extends('backend.layouts.master')

@section('body')
<div class="container-fluid">
    <div class="text-center m-1">
        <h3>Welcome to Admin panel</h3>
    </div>
    <div class="row py-5">
        <div class="col-4">
            <div class="small-box bg-success py-5">
                <div class="inner">
                    <h3>{{$soldgames->count()}}<sup style="font-size: 20px"></sup></h3>

                    <h5>Sold Game till Date</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <!-- <a href="{{route('admin.manufacturer.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-warning py-5">
                <div class="inner">
                    <h3>{{$users->count()}}<sup style="font-size: 20px"></sup></h3>

                    <h5>Users Registered</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <!-- <a href="{{route('admin.console.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
        <div class="col-4">
            <div class="small-box bg-info py-5">
                <div class="inner">
                    <h3>{{$games->count()}}<sup style="font-size: 20px"></sup></h3>

                    <h5>Games Registered</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <!-- <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
    </div>
</div>


@endsection