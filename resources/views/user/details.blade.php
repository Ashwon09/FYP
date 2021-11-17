@extends('user.layouts.master')

@section('body')

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card mt-4">
            <div class="card-header text-center text-white bg-dark mb-3 ">
                <h2>User Details</h2>
            </div>
            <table class="table-custom">
                <tr>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{$user->phone_number}}</td>
                </tr>
            </table>

            <div class="card-footer  text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#editmodal">Edit Information <i class="far fa-edit"></i></button>
            </div>
        </div>
    </div>
    <div class="col-4"></div>
</div>


<div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="main_form" action="{{route('user.update')}}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" value="{{$user->email}}" name="email" readonly>
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="number" class="form-control" id="phone_number" value="{{$user->phone_number}}" name="phone_number">
                        <span class="text-danger error-text phone_number_error"></span>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function() {
        $('#main_form').on('submit', function(e) {
            console.log('pressed')
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        alert(data.msg);
                        window.location.replace("{{route('user.details')}}");
                    }
                }
            });
        });
    });
</script>
@endpush