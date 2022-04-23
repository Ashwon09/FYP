@extends('frontend.layouts.master')

@section('body')
@if(session()->has('message'))
<div class="alert alert-danger fade in alert-dismiss show">
    {{ session()->get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:20px">x</span>
</div>
@endif
<div class="container-fluid mb-5">
    <div class="jumbotron">
        <h1 class="display-4">Hello, Welcome to Game Change Nepal!</h1>
        <p class="lead">Where you can buy exchange and sell games</p>
    </div>
    <div class="row">

        <div class="col-3">
            @include('filter')
        </div>
        <div class="col-9 border border-primary rounded">
            <div class="text-center">
                <h2>Games Listed</h2>

                <form action="{{route('search')}}">
                    <input type="text" placeholder="Search Games" value="{{isset($search)?$search:''}}" name="search">
                    <button type="submit" class="btn btn-success">Search <i class="fas fa-search ml-1"></i></button>
                </form>
                <div class="text-right">
                    @if (!isset($count))
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort By
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('sortByPricedesc')}}" id="sort-price">Price (High to Low)</a>
                            <a class="dropdown-item" href="{{route('sortByPriceasc')}}" id="sort-price">Price (Low to High)</a>
                            <a class="dropdown-item" href="{{route('sortByCreatedasc')}}" id="sort-name">Created (Old to New)</a>
                            <a class="dropdown-item" href="{{route('sortByCreateddesc')}}" id="sort-name">Created (New to Old)</a>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @if(isset($count) and $count==0)
            <div class="alert alert-danger fade in alert-dismiss show mt-4">
                No Games Found
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </div>
            @endif
            @if(isset($count) and $count>0)
            <div class="alert alert-success fade in alert-dismiss show mt-4">
                <p>{{$count}} games found</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </div>
            @endif
            @if(isset($count) and 0>$count)
            <div class="alert alert-success fade in alert-dismiss show mt-4">
                <p>Filtered Games</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </div>
            @endif

            <div class="row mx-5">
                @include('search')
            </div>
            <div class="text-center mar">
                @if (isset($count))
                {!! $games->appends(Request::except('page'))->render() !!}
                @else
                {{$games->links()}}
                @endif
            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .link {
        width: 15rem;
        color: black;
    }

    .link:hover {
        color: grey;
        text-decoration: none;
    }

    .mar {
        margin-right: 10rem;
    }

    .cust-card {
        border-width: 2.5px;
    }

    .custom-image {
        border-width: 1px;
        border: solid;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.mult').select2();
    });
</script>
@endpush