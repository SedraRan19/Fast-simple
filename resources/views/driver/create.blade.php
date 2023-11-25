
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<style>
    .error{
        color:red;
        margin:10px;
        cursor: pointer !important;
    }
    .model-head{
        background-color:#f8f8f8 !important;
    }
    .model-content-custom{
        background-color:#f8f8f8 !important;
    }
</style>
@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Driver</span>
        </div>
    </div>
    <form method="post" action="{{route('store_driver')}}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            {{-- <div class="row py-2">
                 <div class="col-md-7">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px;margin-top:7px;">Pending payout <span id="pendig_payout"> $0</span></p>
                </div>
                 <div class="col-md-5">

                    <a href="javascript:void(0);" id="driver_payment"  class="back-sky color-white border-radius-30" style="z-index:10;">
                        <button class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                        type="button">Mark as paid</button>
                    </a>

                </div>
            </div> --}}
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
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="first_name" placeholder="Type First Name"
                    value="{{old('first_name')}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="last_name" placeholder="Type Last Name"
                    value="{{old('last_name')}}" />
                <div class="stroke-line wrapper pb-3"></div>
               
            </div>
            <div class="px-4 py-2 row">
                <input type="email"
                    class="wrapper border-none background-white outline-none"
                    name="email" placeholder="Type Email"
                    value="{{old('email')}}" />
                <div class="stroke-line wrapper pb-3"></div>
                
                    <span class="invalid-feedback" role="alert">
                        <strong>error</strong>
                    </span>
                
            </div>
            <div class="px-4 py-2 row">
                <input type="tel" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    class=" wrapper border-none background-white outline-none"
                    name="phone" placeholder="Type Phone Number" oninput="formatAllPhoneNumbers(this);"
                    value="{{old('phone')}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Payment Method</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class="wrapper border-none background-white outline-none"
                    name="payment_method" placeholder="Type Payment Method"
                    value="" >{{old('payment_method')}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                    type="submit">Save</button>
                </div>
            </div>
        </div>
    </form>


@endsection

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyATQgdZ12KKj6Kty5bJS90dnB9BUNEYnYg&sensor=false&libraries=places&callback=initAutocomplete&types=airport"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
var delete_url = "{{url('drivers/delete')}}";
var driver_payout = "{{url('drivers/payout')}}";

$(document).on('click', 'input[type="checkbox"]', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
});

</script>
