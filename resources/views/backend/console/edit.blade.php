@extends('backend.layouts.master')

@section('body')

<div class="row">
    <div class=col-1></div>
    <div class="col-10">
        <div class="card border-secondary  mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>Edit Console</h2>
            </div>
            <div class="p-3">
                <form action="{{route('admin.console.update',$console->id)}}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                        <label for="name">Manufacturer:</label>
                        <select class="form-control" id="manufacturer_id" name="manufacturer_id">
                            <option disabled selected>Select Manufacturer</option>
                            @foreach($manufacturers as $manufacturer)
                            <option value="{{$manufacturer->id}}" @if ($console->manufacturer_id==$manufacturer->id) selected @endif>{{$manufacturer->manufacturer_name}}</option>
                            @endforeach
                        </select>
                        <span style="color:red"> @error ('manufacturer_id'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Console Name:</label>
                        <input type="text" class="form-control" id="console_name" value="{{$console->console_name}}" placeholder="Enter Console's Name" name="console_name">
                        <span style="color:red"> @error ('console_name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Console Description:</label>
                        <textarea class="form-control" id="console_description" name="console_description" placeholder="Enter Console's Description" rows="4">{{$console->console_description}}</textarea>
                        <span style="color:red"> @error ('console_description'){{$message}}@enderror</span>
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