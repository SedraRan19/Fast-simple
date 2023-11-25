@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Checkout</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 py-2">
            <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" id="plan" value="{{ $plan->slug }}">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                        placeholder="Name on the card">
                </div>
                <div class="form-group">
                    <label for="">Card details</label>
                    <div id="card-element"></div>
                </div>
                <p id="card-error" class="text-danger"></p>


                <button type="submit" class="btn btn-primary w-100" id="card-button"
                    data-secret="{{ $data['intent']['client_secret'] }}">Pay</button>
            </form>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>


    <script>
        const stripe = Stripe(
            'pk_test_51IUxMgHXJdvNSq45I11SBknIE2HZoY6QQpoeoqviawThlMozBCpnonrNwSqjJdpPWzIUinnNKtB2FRynAeCRWCsq00auAvukD5'
            )

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardBtn.disabled = true
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )

            if (error) {
                $('#card-error').html(error.message);
                cardBtn.disable = false
                return false
            } else {
                let token = document.createElement('input')

                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)

                form.appendChild(token)

                form.submit();
            }
        })
    </script>
@endsection
