@extends('layouts.layout')


@section('title')
new org
@endsection


@section('content')
@csrf

<style>
    .error {
        color: red;
        font-size: 19px;
    }
</style>


<body>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> New Organization</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('organizations.index') }}" title="Go back">
                    <i class="fas fa-backward "></i>
                </a>
            </div>
        </div>
    </div>

    <form id="basic-form" action="{{ route('organizations.store') }}" method="POST">

        @csrf

        <div class="row">



            <div class="form-group">
                <div>
                    <label for="name">name </label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name" />
                    <small id="name" class="form-text text-muted"></small>
                </div>

                <div>
                    <label for="location">location </label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="location" />
                    <small id="location" class="form-text text-muted"></small>
                </div>

                <div>
                    <label for="employees">employees </label>
                    <input type="text" name="employees" class="form-control" id="employees" placeholder="employees" />
                    <small id="employees" class="form-text text-muted"></small>
                </div>

            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->

    @section('page_js')
    <script src="{{asset('assets/js/organization.js')}}"></script>
    @endsection



    @endsection