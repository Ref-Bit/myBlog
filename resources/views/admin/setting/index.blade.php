@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Blog Settings
        </div>

        <div class="panel-body">
            <form action="{{route('setting.update')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Site Name</label>
                    <input type="text" name="site_name" value="{{$settings->site_name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" name="address" value="{{$settings->address}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Contact Email</label>
                    <input type="email" name="contact_email" value="{{$settings->contact_email}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">Contact Phone</label>
                    <input type="text" name="contact_number" value="{{$settings->contact_number}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="name">About</label>
                    <textarea name="about" id="summernote" cols="6" rows="6" class="form-control">{{$settings->about}}</textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit" >Update Site Settings</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">

@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection