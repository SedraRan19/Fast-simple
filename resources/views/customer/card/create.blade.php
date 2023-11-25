@extends('layouts.app')
@section('content')
<div class="row py-4">
    <div class="col-md-12">
      <a href="{{route('cards',['id'=>$customer->id])}}"><i class="fa fa-arrow-left p-4"></i></a>
      <span class="text-center font-weight-bold text-dark maintitlecustomer">Cards</span>
    </div>
  </div>
    <form method="post" action="{{route('store_card',['id'=>$customer->id])}}">
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
                    name="card_holder_name" placeholder="Type Card Name"
                    value="{{old('card_holder_name')}}" required />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <input type="number"
                    class="wrapper border-none background-white outline-none"
                    name="card_number" placeholder="Type Card Number"
                    value="{{old('card_number')}}"  required/>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input 
                    class="wrapper border-none background-white outline-none"
                    name="expiration_date" placeholder="Type Expiration Date"
                    pattern="\d{2}/\d{2}"
                    value="{{old('expiration_date')}}" required />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="number"
                    class="wrapper border-none background-white outline-none"
                    name="cvv" placeholder="Type CVV"
                    pattern="\d{3}" required />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="number"
                    class="wrapper border-none background-white outline-none"
                    name="zip" placeholder="Type Zip"
                    value="{{old('zip')}}" required />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button class="text-center p-4 wrapper selectable-button-selected font120 letter-spacing-1 text-white"
                   style="color:white;" type="submit">Save</button>
                </div>
            </div>
        </div>
    </form>

@endsection
