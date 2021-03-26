@extends('layouts.app')
@section('content')

    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-10"><h2>Details of Locations</h2></div>
            <div class="col-lg-2">
                <a href="{{route('locations.index')}}" class="btn btn-outline-primary"><i class="fas fa-chevron-left" ></i></a>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name   :</strong> {{$locations->name}}<br><br>
                <strong>Email  :</strong> {{$locations->email}}<br><br>
                <strong>Business_name:</strong> {{@$locations->business->name}}<br><br>
                <strong>Created By :</strong> {{@$locations->user->name}}<br><br>
            </div>
        </div>
    </div>
@endsection
