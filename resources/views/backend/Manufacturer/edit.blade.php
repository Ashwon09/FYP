@extends('backend.layouts.master')

@section('body')

<div class="row">
    <div class=col-1></div>
    <div class="col-10">
        <div class="card border-secondary  mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>Edit Manufacturer</h2>
            </div>
            <div class="p-3">
                <form action="{{route('admin.manufacturer.update', $manufacturer->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                        <label for="name">Manufacturer Name:</label>
                        <input type="text" class="form-control" id="manufacturer_name" placeholder="Enter Manufacturer's Name" value="{{$manufacturer->manufacturer_name}}" name="manufacturer_name">
                        <span style="color:red"> @error ('manufacturer_name'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Manufacturer Description:</label>
                        <textarea class="form-control" id="manufacturer_description" name="manufacturer_description" placeholder="Enter Manufacturer's Description" rows="4">{{$manufacturer->manufacturer_description}}</textarea>
                        <span style="color:red"> @error ('manufacturer_description'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="image">Manufacturer's Image:</label>
                        <input type="file" name="manufacturer_image" class="form-control" id="image_input">
                        <span style="color:red"> @error ('manufacturer_image'){{$message}}@enderror</span>
                    </div>
                    <div class="image-holder ml-3">
                        <img src="{{asset('uploads/manufacturer/' . $manufacturer->manufacturer_image)}}" style="max-width:100px;margin-bottom:10px;">
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

<script>
    $(function() {
        $('#image_input').on('change', function() {
            let image_path = $(this)[0].value;
            var image_holder = $('.image-holder');
            var extension = image_path.substring(image_path.lastIndexOf('.') + 1).toLowerCase();

            if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
                if (typeof(FileReader) != 'undefined') {
                    image_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('<img/>', {
                            'src': e.target.result,
                            'class': 'img-fluid',
                            'style': 'max-width:100px;margin-bottom:10px;'
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    $(image_holder).html('This browser does not support fileReader');
                }

            } else {
                $(image_holder).empty();
            }
        });
    });
</script>



@endpush