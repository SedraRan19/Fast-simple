@extends('layouts.app')
@section('content')

    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Refund</span>
        </div>
    </div>
    <div class="settings-panel" style="margin: 65px 10px !important;">
        <div class="row text-center">
            <div class="col-md-12">
                <span class="changeLogo"><img class="position-relative p-2 back-white"
                    src="{{ asset('/images/fast-simple-logo.png') }}"
                    style="margin-top: -80px; width: 204px; height: auto;" /></span>
            </div>
        </div>
        <form method="post" action="{{ url('save-refund') }}">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            <input type="hidden" name="customer_id" value="{{ $trip->customer_id }}">
            <div class="px-4 py-2 pt-5 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Trip cost</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input class="wrapper border-none back-white outline-none font-weight-bold" name="trip_cost" readonly
                    value="@if (isset($trip->price)) {{ $trip->price }} @endif" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 pt-5 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Refund amount</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input required type="text" onkeypress="return isNumberKey(this, event);" class="wrapper border-none back-white outline-none font-weight-bold"
                    name="refund_amt" value="@if (isset($trip->price)) {{ $trip->price }} @endif"/>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <input
                        class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                        id="Profile_save" name="save" type="submit" value="Refund" />
                </div>
            </div>
        </form>
    </div>
@endsection
