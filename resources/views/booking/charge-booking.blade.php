@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Card Details</span>
            <a href="javascript: history.go(-1)" class="float-right font200 color-red mt-3">&times;</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 py-2 past_trips">
            @if (isset($details) && count($details) > 0)
                @php($i = 1)
                @foreach ($details as $detail)
                    <div class="row pr-4 pl-4 pt-4 customer_block" id="card_{{ $detail->id }}">
                        <div class="col-md-12 back-white border-radius-10">
                            <div class="row px-3 pt-3">
                                <div class="col-md-12"><span class="font160">{{ $detail->card_brand }}</span></div>
                            </div>
                            <div class="row px-3 mt-3">
                                <div class="col-md-12"><span class="font120">Number : ************
                                        {{ $detail->card_last_four }}</span></div>
                            </div>
                            <div class="col-md-3 pull-right p-2">
                                <a onclick="chargePlan({{ $customer_id }},{{ $trip_id }},{{ $i }})">
                                    <div class="text-center wrapper selectable-button-selected px-4 py-2"
                                        id="charge_{{ $customer_id }}_{{ $trip_id }}_{{ $i }}"
                                        style="color:white;">Use</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            @else
                <div class="row pr-4 pl-4 pt-4 customer_block" id="card">
                    <div class="col-md-12 back-white border-radius-10">
                        <div class="row px-3 pt-3">
                            <div class="col-md-12"><span class="font120">NO PAYMENTS ADDED YET</span></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12 px-3 pb-2 mt-5">
        <a href="{{ url('add-customer-payment/' . $customerId . '/' . $tripId) }}">
            <div class="text-center wrapper selectable-button-selected px-3 py-3" style="color:white;" id="">ADD
                ANOTHER</div>
        </a>
    </div>


@endsection
