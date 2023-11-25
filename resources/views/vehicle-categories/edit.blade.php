@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Vehicle Category</span>
        </div>
    </div>

    {{-- {{ isset($vehicleCategory) ? route('vehicle-categories.update', $vehicleCategory->id) : route('vehicle-categories.store') }} --}}
    <form method="post" action="{{route('edit_vehicle_category',['id'=>$category->id])}}">
        @csrf
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
                    style="letter-spacing: 0.7px">Category Title</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="name" placeholder="Type Category Title"
                    value="{{$category->name}} " />
                <div class="stroke-line wrapper pb-3"></div>
        </div>

        <div class="px-4 py-2 pt-4 row">
            <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                style="letter-spacing: 0.7px">Price Per Hour ($)</p>
            <div class="stroke-line wrapper pb-3"></div>
        </div>
        <div class="px-4 py-2 row">
            <input
                class="wrapper border-none background-white outline-none"
                name="price_per_hour" placeholder="Type Price Per Hour"
                value="{{$category->price_per_hour}}"/>
            <div class="stroke-line wrapper pb-3"></div>
            
        </div>

    <div class="px-4 py-2 pt-4 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
            style="letter-spacing: 0.7px">Price Per Mile ($)</p>
        <div class="stroke-line wrapper pb-3"></div>
    </div>
    <div class="px-4 py-2 row">
        <input
            class="wrapper border-none background-white outline-none"
            name="price_per_mile" placeholder="Type Price Per Mile"
            value="{{$category->price_per_mile}}" />
        <div class="stroke-line wrapper pb-3"></div>
</div>

<div class="px-4 py-2 pt-4 row">
    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
        style="letter-spacing: 0.7px">Base Price ($)</p>
    <div class="stroke-line wrapper pb-3"></div>
</div>
<div class="px-4 py-2 row">
    <input
        class="wrapper border-none background-white outline-none"
        name="base_price" placeholder="Base Price"
        value="{{$category->base_price}}" />
    <div class="stroke-line wrapper pb-3"></div>
</div>

<div class="px-4 py-2 pt-4 row">
    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
        style="letter-spacing: 0.7px">Miles Included</p>
    <div class="stroke-line wrapper pb-3"></div>
</div>
<div class="px-4 py-2 row">
    <input
        class="wrapper border-none background-white outline-none"
        name="miles_inclided" placeholder="Miles Included"
        value="{{$category->miles_inclided}}" />
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
@endsection
