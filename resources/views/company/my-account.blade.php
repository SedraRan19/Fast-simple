@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">My Account</span>
        </div>
    </div>

    <form action="{{route('update_company',['id'=>$company->id])}}" method="POST" id="profile_form">
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
        <div class="settings-panel">
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none back-white outline-none font-weight-bold"
                    name="name" placeholder="Enter your company name"
                    value="{{$company->name}}" />
                <div class="stroke-line wrapper pb-3"></div>
        </div>
        <div class="px-4 py-2 row">
            <input id="company_address"  onfocus="geolocate();"
                class="wrapper border-none back-white outline-none font-weight-bold"
                name="address" placeholder="Using google address to select"
                value="{{$company->address}}" />
            <div class="stroke-line wrapper pb-3"></div>
            
    </div>
    <div class="px-4 py-2 row">
        <input
            class="wrapper border-none back-white outline-none font-weight-bold"
            name="registration" placeholder="DOT, CPNC, PUC..."
            value="{{$company->registration}}" />
        <div class="stroke-line wrapper pb-3"></div>
</div>

<div class="px-4 py-2 row">
    <input class="wrapper border-none back-white outline-none font-weight-bold" name="email"
        placeholder="Enter your Email Address"
        value="{{$user->email}}" readonly />
    <div class="stroke-line wrapper pb-3"></div>
    
</div>
<div class="px-4 py-2 row">
<input onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
    class=" wrapper border-none back-white outline-none font-weight-bold"
    name="phone" placeholder="Phone Number" oninput="formatAllPhoneNumbers(this);"
    value="{{$user->phone}}"
    readonly type="tel"
    id="passenger_phone" />
<div class="stroke-line wrapper pb-3"></div>

</div>
<div class="px-4 py-2 pt-4 row">
    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0" style="letter-spacing: 0.7px">Your current plan : Free Trial</p>
    <div class="stroke-line wrapper pb-3"></div>
        <div class="col-md-6">
            <a href="{{route('plans')}}" class="text-center p-3 wrapper selectable-button-selected font120" style="color:white;" type="button">Upgrade</a>
        </div>     
 </div>
<div class="px-4 py-2 row mt-5">
<div class="col-md-12">
<input class="text-center p-4 wrapper selectable-button-selected font120" style="color:white;"
    name="save" type="submit" value="Save" />
</div>
</div>
</form>
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
