<link type="text/css" rel="stylesheet" href="{{asset('css/image-uploader.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">

@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Vehicle</span>
        </div>
    </div>
    {{-- {{ isset($vehicle) ? route('vehicles.update', $vehicle->id) : route('vehicles.store') }} --}}
    <form method="post" enctype="multipart/form-data" action="{{route('store_vehicle')}}">
        @csrf
        {{-- <div class="row p-4" style="padding-bottom:0px !important">
            <h4> Exterior </h4>
          </div>
          <div class="row p-4" style="padding-bottom:0px !important">

            <div class="col-md-12">
                <div class="input-images-1"></div>
            </div>
          </div>

          <div class="row p-4" style="padding-bottom:0px !important">
            <h4> Interior </h4>
          </div>

          <div class="row p-4" style="padding-bottom:0px !important">

            <div class="col-md-12">
              <div class="input-images"></div>
            </div>

          </div> --}}
        <div class="settings-panel" style="margin: 65px 10px !important;">
            @if(session()->has("success"))
                <div class="alert alert-success" >
                    {{session()->get('success')}}
                </div>
            @endif
            @if(session()->has("error"))
                    <div class="alert alert-danger" >
                        {{session()->get('error')}}
                    </div>
            @endif
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Vehicle Make</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="make" placeholder="Type Make"
                    value="" />
                <div class="stroke-line wrapper pb-3"></div>
               
        </div>

        <div class="px-4 py-2 pt-4 row">
            <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                style="letter-spacing: 0.7px">Vehicle Model</p>
            <div class="stroke-line wrapper pb-3"></div>
        </div>
        <div class="px-4 py-2 row">
            <input
                class="wrapper border-none background-white outline-none"
                name="model" placeholder="Type Model"
                value="" />
            <div class="stroke-line wrapper pb-3"></div>
          
    </div>

    <div class="px-4 py-2 pt-4 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
            style="letter-spacing: 0.7px">License Plate</p>
        <div class="stroke-line wrapper pb-3"></div>
    </div>
    <div class="px-4 py-2 row">
        <input
            class="wrapper border-none background-white outline-none"
            name="license_plate" placeholder="Type License Plate"
            value="" />
        <div class="stroke-line wrapper pb-3"></div>
    </div>
    <div class="px-4 py-2 pt-4 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
            style="letter-spacing: 0.7px">Vehicle Category</p>
        <div class="stroke-line wrapper pb-3"></div>
        </div>
        <div class="px-4 py-2 row">
         <select
            class="wrapper border-none background-white outline-none p-2"
            name="vehicle_category_id">
            <option selected disabled>Select Category</option>
            @foreach($categories as $item)
                <option value="{{$item->id}}" selected>{{$item->name}}</option>
            @endforeach
        </select>
        <div class="stroke-line wrapper pb-3"></div>
        </div>

    <div class="px-4 py-2 row">
    <div class="col-md-12">
    <button
        class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
        type="submit">Save
    </button>
    </div>
    </div>
    </div>
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('js/image-uploader.min.js')}}"></script>


@endsection
