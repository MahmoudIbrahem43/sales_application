@extends('layouts.layout')


@section('title')
Org index
@endsection


@section('content')
@csrf


<!-- main content -->
<div class="container mt-5">
    <h2 class="mb-4">organization</h2>
    <div>
        <a href="{{route('organizations.create')}}">Add new Org</a>
    </div>
    <br>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>location</th>
                <th>employee</th>
                <th>#</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

    @section('page_js')
    <script src="{{asset('assets/js/organization.js')}}"></script>
    @endsection

    @endsection