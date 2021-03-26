@extends('layouts.app')

@section('content')
    @php
        $i = 1;
    @endphp
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-10">
                <h2>Locations List</h2>
            </div>
            <div class="col-lg-2 ">
                <a href="{{route('locations.create')}}" class="btn btn-success"><i class="fas fa-plus-circle" ></i></a>
            </div>
        </div>
    </div>

    @if($msg = Session::get('success'))
        <div class="alert alert-success">
            {{$msg}}
        </div>
    @endif

    <div class="container pt-3">
        <table class="table table-bordered dataTable dataTables_paginate dataTables_wrapper" id="myTable2">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Business Name</th>
                <th>Created By</th>
                <th width="300px">Actions</th>
            </tr>
            @foreach($locations as $location)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$location->name}}</td>
                    <td>{{$location->email}}</td>
                    <td>{{@$location->business->name}}</td>
                    <td>{{@$location->user->name}}</td>
                    <td>

                        <form action="{{route('locations.destroy', $location->id)}}"  method="post">
                            @csrf
                            <a href="{{route('locations.show',  $location->id)}}" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
                            <a href="{{route('locations.edit',  $location->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger" id="deleteLocation"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <span>{{$locations->links()}}</span>
    </div>

@endsection



