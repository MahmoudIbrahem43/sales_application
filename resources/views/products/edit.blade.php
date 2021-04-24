@extends('layouts.layout')


@section('title')
edit product
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
            <h2>edit product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>
    </div>
</div>





<form id="basic-form2" action="{{ route('products.update', $productViewObject['product']->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row">



        <div class="form-group">

            <div>
                <label for="name">name </label>
                <input type="text" name="name" class="form-control" id="name" value="{{$productViewObject['product']->name}}" require> </input>
                <small id="name" class="form-text text-muted"></small>
            </div>

            <div>
                <label for="logo">logo </label>
                <img src="{{ asset($productViewObject['product']->logo)}}" height="200" width="200">
                <input type="file" name="logo" class="form-control" id="logo" value="{{$productViewObject['product']->logo}}"> </input>
                <small id="logo" class="form-text text-muted"></small>
            </div>

            <div>
                <label for="price">price </label>
                <input type="number" name="price" class="form-control" id="price" value="{{$productViewObject['product']->price}}" require> </input>
                <small id="price" class="form-text text-muted"></small>
            </div>

            <!-- 
            <div>
                <label for="organization_id">organization_id </label>
                <input type="text" name="organization_id" class="form-control" id="organization_id" value="{{$productViewObject['product']->organization_id}}" require> </input> 
                <small id="organization_id" class="form-text text-muted"></small>
            </div> -->


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="organization_id">Choose a org :</label>
                    <select name="organization_id" id="organization_id" class="form-control">
                        @foreach($productViewObject['organizations'] as $organization)
                        @php
                        $iseleted = '';
                        if($organization->id == $productViewObject['product']->organization_id){
                         $iseleted = 'selected'; 
                        }
                        @endphp
                        <option value="{{$organization->id}}" {{$iseleted}}>{{$organization->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>




@section('page_js')
<script>
    $(document).ready(function() {
        $('form[id="basic-form2"]').validate({
            rules: {
                name: "required",
                // logo:"required",
                price: "required",
                organization_id: "required",
            },
            messages: {
                name: 'This field is required',
                // logo: 'This field is required',
                price: 'This field is required',
                organization_id: 'This field is required',
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
@endsection



@endsection