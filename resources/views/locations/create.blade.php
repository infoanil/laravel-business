@extends('layouts.app')
@section('content')

    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-10"><h2>Create Full Business</h2></div>
            <div class="col-lg-2">
                <a href="{{route('locations.index')}}" class="btn btn-outline-primary"><i class="fas fa-chevron-left" ></i></a>
            </div>
        </div>
    </div>

    <div class="container pt-3">
        <form action="{{route('locations.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" id="name" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" placeholder="Enter Email" id="email">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="business">Select Business:</label>
                <select class="form-control" id="business" name="business_id">
                    @foreach($businesses as $business)
                    <option value="{{$business->id}}">{{$business->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@section('scripts')
        <script>
            $(document).ready(function() {
                $('#business').select2({
                    placeholder : "Select a businesses",
                    allowclear : true,
                });
            });
        </script>
@endsection



