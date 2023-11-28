@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Manage Booking</span>
        </div>
    </div>

    <div class="row py-2">

    </div>

    <div class="row">
        <div class="col-md-12 py-2 past_trips">
            <div class="row pr-4 pl-4 pt-4 customer_block">
                <div class="col-md-12 back-white border-radius-10">
                    <div class="row px-3 pt-3">
                        <div class="col-md-12"><span class="font160"><b>{{$trip->customer->first_name.' '.$trip->customer->last_name}}</b></span>
                            <!-- <a href="javascript: history.go(-1)" class="float-right font200 color-red">&times;</a> -->
                            <br> <span class="font120"><b>{{ $trip->trip_date.' '.$trip->start_time}}</b></span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>Vehicle</b>: {{$trip->vehicle->make.' '.$trip->vehicle->model}}</span></div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>From</b>: {{$trip->from_location}}</span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>To</b>: {{$trip->to_location}}</span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>Price</b>: {{'$'.$trip->price}}</span>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <a href="">
                                <div class="text-center wrapper selectable-button-selected px-3 py-3"
                                    style="color:white;">Mark as unpaid</div>
                            </a>
                        </div>
                        <div class="row px-3 pb-2 pt-1">
                            <div class="col-md-6">
                                <a href="{{route('refund_booking',['trip_id'=>$trip->id])}}">
                                    <div class="text-center wrapper selectable-button-selected px-3 py-3"
                                        style="color:white;">Refund</div>
                                </a>
                            </div>
                            </div class="col-md-6">
                            <a href="{{route('charge_booking',['id'=>$trip->id])}}">
                                <div class="text-center wrapper selectable-button-selected px-3 py-3" id="charge"
                                    style="color:white;">Charge</div>
                            </a>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
