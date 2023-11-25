@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Manage Booking</span>
        </div>
    </div>

    <div class="row py-2">

    </div>

    <div class="row">
        <div class="col-md-12 py-2 past_trips">
            <div class="row pr-4 pl-4 pt-4 customer_block">
                <div class="col-md-12 back-white border-radius-10">
                    <div class="row px-3 pt-3">
                        <div class="col-md-12"><span class="font160">summary</span>
                            <!-- <a href="javascript: history.go(-1)" class="float-right font200 color-red">&times;</a> -->
                            <br> <span class="font120">07-10-2023 14:45</span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>Passenger Name</b> Ranivo </span></div>
                    </div>

                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>Vehicle</b> Toyota corola</span></div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>From</b> Parsi</span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>To</b> Marsaille/span>
                        </div>
                    </div>
                    <div class="row px-3 mt-3">
                        <div class="col-md-12"><span class="font120"><b>Price</b>: $12.99</span>
                        </div>
                    </div>
                            <div class="col-md-6">
                                <a href="">
                                    <div class="text-center wrapper selectable-button-selected px-3 py-3"
                                        style="color:white;">Mark as unpaid</div>
                                </a>
                            </div>
                            </div class="col-md-5">
                                <a href="">
                                    <div class="text-center wrapper selectable-button-selected px-3 py-3" id="charge"
                                        style="color:white;">Charge</div>
                                </a>
                            </div>
                            <div class="row px-3 pb-2 pt-1">
                                <div class="col-md-5">
                                    <a href="">
                                        <div class="text-center wrapper selectable-button-selected px-3 py-3"
                                            style="color:white;">Refund</div>
                                    </a>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <script>
        function statusPaid(id) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{ url('/status-change') }}",
                type: "POST",
                data: {
                    'id': id
                },
                success: function(response) {
                    console.log(response)
                    if (response == 'Success') {
                        $('#success-msg').show();
                        window.location.reload();
                    }
                },
            });
        }

        function chargePlan(id) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{ url('/chargePlan') }}",
                type: "POST",
                data: {
                    'id': id
                },
                beforeSend: function() {
                    $('#charge').text('Loading...')
                },
                success: function(response) {
                    console.log(response);
                    if (response == 'Success') {
                        $('#charge').text('Charge');
                        $('#charge-success-msg').show(1).delay(1000).hide(1);
                    }
                },
            });
        }

        function selectPlan() {
            $('#error-msg').show(1).delay(1000).hide(1);

        }
    </script>
@endsection
