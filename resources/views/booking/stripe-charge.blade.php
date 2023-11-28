@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Charge</span>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Make A Payment</h1>
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
                <form action="{{route('use_card',['card_id'=>$card->id,'trip_id'=>$trip->id])}}" method="POST" id="payment-form">
                    @csrf
                    <div class="mb-3">
                        <label for="card-name" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Your name</label>
                        <input type="text" name="name" id="card-name" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->card_holder_name}}"> 
                    </div>
                    <div class="mb-3">
                        <label class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Email</label>
                        <input type="email" name="email" id="email" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$trip->customer->email}}">
                    </div>
                    <div class="mb-3">
                        <label  class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Number</label>
                        <input type="text" name="number" id="card-number" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->card_number}}">
                    </div>
                    <div class="mb-3">
                        <label  class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Expiration Month</label>
                        <input type="text" name="expiry_month" id="card-expiry-month" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->expiration_date}}">
                    </div>
                    <div class="mb-3">
                        <label  class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Expiration Year</label>
                        <input type="text" name="expiry_year" id="card-expiry-year" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->expiration_date}}">
                    </div>
                    <div class="mb-3">
                        <label  class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">CVV</label>
                        <input type="text" name="cvv" id="card-cvc" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->cvv}}">
                    </div>
                    <div class="mb-3">
                        <label  class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">ZIP</label>
                        <input type="text" name="zip" id="zip" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full" value="{{$card->zip}}">
                    </div>
                    <button type="submit" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-white px-6 h-12">Pay 👉</button>
                </form>
            </div>
        </div>
    
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('pk_test_51O44BvLO2po27QjUeviDvyRurhG6hDhUSWKKj9epTpxG9V5jwTnxg68P98FQsDzW5CY6TcmtXG2ZYVN5OFJKSRYJ00ukIemAHZ');
            
            var elements = stripe.elements();
        
            var card = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#32325d',
                    },
                },
            });
        
            card.mount('#card-number');
        
            document.getElementById('submit-payment').addEventListener('click', function () {
                stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                }).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        alert(result.error.message);
                    } else {
                        // Send the PaymentMethod ID to your server
                        stripeTokenHandler(result.paymentMethod.id);
                    }
                });
            });
        
            function stripeTokenHandler(paymentMethod) {
                // Insert the PaymentMethod ID into the form
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', paymentMethod);
                form.appendChild(hiddenInput);
        
                // Submit the form
                form.submit();
            }
        </script>
        
@endsection
