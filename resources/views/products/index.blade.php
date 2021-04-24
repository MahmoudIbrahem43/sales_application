@extends('layouts.layout')


@section('title')
product index
@endsection


@section('content')
@csrf


<!-- main content -->
<div class="container mt-5">
    <h2 class="mb-4">products</h2>
    <div>
        <a href="{{route('products.create')}}">Add new product</a>
    </div>
    <br>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>logo</th>
                <th>price</th>
                <th>organization_id</th>
                <th>#</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

    @section('page_js')
    <script src="{{asset('assets/js/product.js')}}"></script>
    @endsection

    @endsection