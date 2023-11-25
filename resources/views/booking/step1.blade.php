@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('store_step_two')}}">
    @csrf

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
    <div class="row py-4">
        <div class="col-md-12">
            <a href=""><i class="fa fa-arrow-left p-4"></i></a>
                <span class="text-center font-weight-bold text-dark maintitle">Create Booking</span>
        </div>
    </div>
    {{-- Summary --}}
    <div class="px-4 row">
        <div class="col-md-12">
            <span class="font-weight-bold">Summary</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
        <input class="border-none background-white-50 outline-none wrapper" name="customer" placeholder="Name" value="{{ $customer->first_name }}" readonly />
        <input class="border-none background-white-50 outline-none wrapper" name="customer_email" placeholder="Email" value="{{ $customer->email }}"  />
        <input class="border-none background-white-50 outline-none wrapper" 
        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
        name="customer_phone" placeholder="Phone" value="{{ $customer->phone }}" oninput="formatAllPhoneNumbers(this); />
        
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
            <input class="border-none background-white-50 outline-none wrapper" name="src-address" placeholder="Not Specified" value="{{$from_location}}" readonly />
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
            <input class="border-none background-white-50 outline-none wrapper" name="dst-address" placeholder="Not Specified" value="{{$to_location}}" readonly />
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
            <input class="border-none background-white-50 outline-none wrapper" name="date" placeholder="Not Specified" value="{{date('M d Y',strtotime($date)).' at ' . $hour.':'.$minute.' '.$ampm }}" readonly />
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    {{-- Passenger --}}
    <div class="px-4 row pt-5">
        <div class="col-md-12">
            <input type="hidden" name="passenger_count" value="" />
            <span class="font-weight-bold">Passenger </span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
            <input class="border-none background-white-50 outline-none wrapper" name="passenger_name" placeholder="Not Specified" value="{{$passenger_name}}" readonly />
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12">
            <input class="border-none background-white-50 outline-none wrapper" name="passenger_number" placeholder="Not Specified" value="{{$passenger_phone}}" readonly />
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    {{-- Price --}}
    <div class="px-4 row pt-5">
        <div class="col-md-12">
            <span class="font-weight-bold">Price : {{'$'.$manual_price}}</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>

    {{-- Assingment Details --}}
    <div class="px-4 row pt-5">
        <div class="col-md-6">
            <span class="font-weight-bold">Assign Vehicle</span>
        </div>

        <div class="col-md-6">
            <select class="wrapper border-none outline-none p-2" id="vehicle_id" name="vehicle_id" >
                @foreach($vehicles as $vehicle)
                <option value="{{$vehicle->id}}">{{$vehicle->make.' '.$vehicle->model}}</option>
                @endforeach
            </select>
        </div>
    </div>

    
        <div class="px-4 row pt-5" id="driver_option">


        <div class="col-md-6">
            <span class="font-weight-bold">Assign Driver</span>
        </div>

        <div class="col-md-6">
            <select class="wrapper border-none outline-none p-2" name="driver_id" >
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->first_name.' '.$driver->last_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
   
        <div class="px-4 row pt-5" id="driver_payout" style="display:none">
    
        <div class="col-md-6">
            <span class="font-weight-bold">Driver Payout</span>
        </div>
        
        <div class="col-md-6">
            <select class="wrapper border-none outline-none p-2"  name="driver_payout">
                <option value="">Select</option>
                    <option value="miles">Miles</option>
                    <option value="percentage">Percentage</option>
            </select>
        </div>


    </div>

    <div class="px-4 row pt-2">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="send_email" value="off">
                    <input type="checkbox" name="send_email" checked value="1" style="width: 20px; height:20px;" />
                    <span style="padding: 0px 0px 0px 10px; vertical-align: super; font-size: 13px;">Email Booking Details to Customer</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="checkbox"  name="add_disclaimer" value="1" style="width: 20px; height:20px;" />
                    <span style="padding: 0px 0px 0px 10px; vertical-align: super; font-size: 13px;">Add disclaimer</span>
                </div>
            </div>

            <!-- <div class="row" id="disclaimer_div" style="display:none">
        <div class="col-md-12">
            <textarea name="description" cols="40" placeholder="Comments" style="resize:none;min-height: 150px;margin: 20px 0px 0px;border-radius: 30px;background: #eee;padding: 15px; outline: none;" spellcheck="true">@if(isset($customer->permanent_note)) {{$customer->permanent_note}} @endif</textarea>
        </div>
    </div> -->

            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-4 py-5 row">
        <div class="col-md-12">
            <input class="text-center p-4 wrapper selectable-button-selected" style="color:white;" id="confirm" name="confirm" type="submit" value="Confirm" />
        </div>
    </div>
</form>
@endsection
<script src="https://unpkg.com/libphonenumber-js/bundle/libphonenumber-js.min.js"></script>
<script>
    function formatAllPhoneNumbers(obj) {
    var txt = $(obj).val();
    var formated;
    if (txt.length == 10) formated = 0000000000;
    else formated = txt;
    $(obj).val(formated);
}

</script>
