@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Customers</span>
        </div>
    </div>
    {{-- {{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }} --}}
    <form method="post" id="customer-card" action="{{route('update_customer',['id'=>$customer->id])}}">
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
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="first_name" placeholder="Type First Name"
                    value="{{$customer->first_name}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="last_name" placeholder="Type Last Name"
                    value="{{$customer->last_name}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="email"
                    class="wrapper border-none background-white outline-none"
                    name="email" placeholder="Type Email"
                    value="{{$customer->email}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="tel" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    class="wrapper border-none background-white outline-none"
                    name="phone" placeholder="Type Phone Number" oninput="formatAllPhoneNumbers(this);"
                    value="{{$customer->phone}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class="wrapper border-none background-white outline-none"
                    name="home_address" placeholder="Type Home Address" id="home-address" onfocus="geolocate();"
                    value="" >{{$customer->home_address}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class=" wrapper border-none background-white outline-none"
                    name="office_address" placeholder="Type Office Address" id="office-address" onfocus="geolocate();"
                    value="" >{{$customer->office_address}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class="wrapper border-none background-white outline-none"
                    name="permanent_note" placeholder="Type Permanent Note"
                    value="" >{{$customer->permanent_note}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class="wrapper border-none background-white outline-none"
                    name="private_general_notes" placeholder="Type General Notes"
                    value="" >{{$customer->private_general_notes}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
                
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="4" cols="50"
                    class="wrapper border-none background-white outline-none"
                    name="driver_notes" placeholder="Type Driver Notes"
                    value="" >{{$customer->driver_notes}}</textarea>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button class="text-center p-4 wrapper selectable-button-selected font120 letter-spacing-1 text-white"
                    id="customer_save" style="color:white;" type="submit">Save Without Card</button>
                </div>
            </div>

            


        </div>
    </form>

    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="closebutton">Alert!</span>
      <p>Deleting the card will prevent you from charging in this system, but will not delete it from your stripe account?</p>
      <div class="row" style="margin-top:10px">
          <div class="col-md-6">
              <div style="color:#fff;font-size:13px !important" class="text-center wrapper selectable-button-selected px-2 py-1 setToggleValue delete_approve_button" data-cid="">Proceed</div>
          </div>
          <div class="col-md-6">
              <div style="color:red;cursor:pointer" class="text-center wrapper px-2 py-1 setToggleValue delete_cancel_button">No Cancel</div>
          </div>
      </div>


  </div>

  </div>
    <script src="https://js.stripe.com/v3/"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyATQgdZ12KKj6Kty5bJS90dnB9BUNEYnYg&sensor=false&libraries=places&callback=initAutocomplete&types=airport"></script>
@endsection
