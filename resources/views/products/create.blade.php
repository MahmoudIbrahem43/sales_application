@extends('layouts.layout')


@section('title')
new product
@endsection


@section('content')
@csrf


<style>
    .error {
        color: red;
        font-size: 19px;
    }
</style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back">
                <i class="fas fa-backward "></i>
            </a>
        </div>
    </div>
</div>


<form id="basic-form2" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="row">
        <div class="form-group">
            <div>
                <label for="name">name :</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="name" />
                <small id="name" class="form-text text-muted"></small>
            </div>

            <!-- <div>
                <label for="logo">logo :</label>
                <input type="text" name="logo" class="form-control" id="logo" placeholder="logo" />
                <small id="logo" class="form-text text-muted"></small>
            </div> -->

            <div class="form-group">
                <label for="chooseFile">logo</label>
                <input type="file" name="logo" class="form-control-file" id="chooseFile">
            </div>



            <div>
                <label for="price">price :</label>
                <input type="number" name="price" class="form-control" id="price" placeholder="price" />
                <small id="price" class="form-text text-muted"></small>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="organization_id">Choose a org :</label>
                    <select name="organization_id" id="organization_id" class="form-control">
                        @foreach($organizations as $organization)
                        <option value="{{$organization->id}}">{{$organization->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

</form>

@section('page_js')
<script src="{{asset('assets/js/product.js')}}"></script>
@endsection



@endsection