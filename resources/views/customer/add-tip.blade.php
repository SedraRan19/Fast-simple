@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Add Tip</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 py-2">
            <form id="payment-form" action="{{ url('post-tip') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Enter TIP Amount</label>
                    <input type="number" required name="price" id="price" class="form-control" value="" placeholder="Enter TIP Amount">
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                </div>

                <div class="form-group">
                    <label for="">Card details</label>
                    <div id="card-element"></div>
                </div>
                <p id="card-error" class="text-danger"></p>

                <button type="submit" class="btn btn-primary w-100" id="card-button" data-secret="{{ $data['client_secret'] }}">Pay</button>
            </form>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>


    <script>
        const stripe = Stripe('{{ config('cashier.key') }}')

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
        )

        if(error) {
            $('#card-error').html(error.message);
            return false
        } else {
            let token = document.createElement('input')
            cardBtn.disable = false
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            $('.payment-method').val(setupIntent.payment_method)

            form.appendChild(token)

            form.submit();
        }
        })
    </script>
@endsection
