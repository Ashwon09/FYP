@extends('user.layouts.master')

@section('body')

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>Delete Users</h2>
            </div>
            <p class="text-center">If you want to delete the User fill the user name({{$user->name}}) in the text box below:</p>
            @if(session()->has('message'))
            <div class="alert alert-danger fade in alert-dismiss show">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">x</span>
            </div>
            @endif
            <form class="m-4" action="{{route('user.deleteUser')}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="User Name" name="name">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-danger">Delete User</button>
                </div>
                <div class="text-secondary">This step cannot be undone</div>
            </form>
        </div>
        <div class="card-footer  text-right">
        </div>
    </div>
</div>
<div class="col-4"></div>
</div>



@endsection
@push('styles')
<style>
    .table-custom {
        border-collapse: separate;
        border-spacing: 26px 15px;
    }
</style>
@endpush

@push('scripts')

@endpush