@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bold registerText">Registration</h4>
        </div>
    </div>
    <form method="post" action="{{route('register_company',['id'=>$user->id])}}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white"
                            src="{{ asset('/images/fast-simple-logo.png') }}"
                            style="margin-top: -80px; width: 204px; height: auto;" /></span>
                </div>
            </div>
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
                    style="letter-spacing: 0.7px">Company name</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input class="wrapper border-none back-white outline-none font-weight-bold" name="name"
                    placeholder="Enter your company name" value="" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Company address</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input id="company_address" class="wrapper border-none back-white outline-none font-weight-bold"
                    onfocus="geolocate();" name="address" placeholder="Using google address to select"
                    value="" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Company registration #</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input class="wrapper border-none back-white outline-none font-weight-bold"
                    name="registration" placeholder="Enter DOT, CPNC, PUC..." value="" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button
                        class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                        type="submit">Complete registration</button>
                </div>
            </div>
        </div>
    </form>
    <script async defer src= "{{asset('js/company-registration.js')}}">
    </script>
    <script type="text/javascript" charset="utf-8">
        // Google Place AutoComplete
        var autocomplete;
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
                    document.getElementById('company_address'), {types: ["geocode", "establishment"]});

        }
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({center: geolocation, radius: position.coords.accuracy});
                    //autocomplete.setBounds(circle.getBounds());
                    //autocomplete2.setBounds(circle.getBounds());
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATQgdZ12KKj6Kty5bJS90dnB9BUNEYnYg&sensor=true&libraries=places&callback=initAutocomplete"></script>

@endsection
