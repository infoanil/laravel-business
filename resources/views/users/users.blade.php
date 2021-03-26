@extends('layouts.app')
@section('content')
        <div class="text-center pt-5">
            <h2>User List</h2>
        </div>
        <br>
        <br>
        <div class="container">
            <table class="table table-bordered text-center m-auto" id="myTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($users as $user)
                        <tr>
                    <td>{{$i++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $.noConflict();
            $('#myTable').DataTable();
        } );
    </script>

@endsection
