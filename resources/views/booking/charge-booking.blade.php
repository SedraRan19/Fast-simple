@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Card Details</span>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12 py-2 past_trips">
            @if (isset($cards) && count($cards) > 0)
                @php($i = 1)
                @foreach ($cards as $card)
                    <div class="row pr-4 pl-4 pt-4 customer_block" >
                        <div class="col-md-12 back-white border-radius-10">
                            <div class="row px-3 pt-3">
                                <div class="col-md-12"><span class="font160">{{$card->card_holder_name}}</span></div>
                            </div>
                            <div class="row px-3 mt-3">
                                <div class="col-md-12"><span class="font120">Number : {{$card->card_number}}</span></div>
                            </div>
                            <div class="col-md-3 pull-right p-2">
                                <a href="{{route('index_charge_stripe',['card_id'=>$card->id,'trip_id'=>$trip->id])}}">
                                    <div class="text-center wrapper selectable-button-selected px-4 py-2"
                                        style="color:white;">Use</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            @else
           
            @endif
        </div>
    </div>
    <div class="col-md-12 px-3 pb-2 mt-5">
        <a href="{{route('create_card',['id'=>$trip->customer_id])}}">
            <div class="text-center wrapper selectable-button-selected px-3 py-3" style="color:white;" id="">ADD
                ANOTHER</div>
        </a>
    </div> --}}
    <div class="row">
            <div class="col-md-12 py-2">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form action="{{route('use_card',['trip_id'=>$trip->id])}}" method="POST" id="card-form">
                    @csrf
                    <div class="from-group">
                        <label for="card-name" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Your name</label>
                        <input type="text" name="name" id="card-name" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{old('name')}}"> 
                    </div>
                    <div class="from-group">
                        <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card details</label>
                        <div id="card"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" >Pay</button>
                </form>
            </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe('{{ env("STRIPE_KEY") }}')
        const elements = stripe.elements()
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    fontFamily: 'Arial, sans-serif',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        const cardForm = document.getElementById('card-form')
        const cardName = document.getElementById('card-name')
        cardElement.mount('#card')
        cardForm.addEventListener('submit', async (e) => {
            e.preventDefault()
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: cardName.value
                }
            })
            if (error) {
                console.log(error)
            } else {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'payment_method')
                input.setAttribute('value', paymentMethod.id)
                cardForm.appendChild(input)
                cardForm.submit()
            }
        })
    </script>
@endsection
