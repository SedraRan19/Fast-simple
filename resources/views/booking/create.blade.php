@extends('layouts.app')
@php
$today = new DateTime();
$tomorrow = new DateTime();
$tomorrow->modify('+1 day');
$date3 = new DateTime();
$date3->modify('+2 day');
$date4 = new DateTime();
$date4->modify('+3 day');
$date5 = new DateTime();
$date5->modify('+4 day');
@endphp
@section('content')
    <style>
     
   .custom-radio {
      display: none;
    }
  
    .custom-radio-label {
      position: relative;
      display: inline-block;
      padding: 10px;
      cursor: pointer;
      text-align: center;
    }
  
    .custom-radio-input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }
  
    .custom-radio-checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 40px;
      width: 40px;
      background-color: #fff;
      border: 2px solid #000;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .custom-radio-checkmark-vehicle {
      position: absolute;
      top: 0;
      left: 0;
      height: 75px;
      width: 75px;
      background-color: #fff;
      border: 2px solid #000;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  
    .custom-radio-label:hover .custom-radio-checkmark {
      background-color: #f4f4f4;
    }
  
    .custom-radio-input:checked + .custom-radio-checkmark {
      background-color: #114b93;
      border-color: #114b93;
    }
  
    .custom-radio-checkmark:after {
      content: attr(data-number);
      color: #000;
      font-weight: bold;
    }
        .disBtn {
            background: darkgray;
            color: white;
            border-color: darkgray;
        }

        .mr-10-bt {
            margin-bottom: 10px;
        }

        .mr-20-bt {
            margin-bottom: 20px;
        }

        .mr-10-t {
            margin-top: 10px;
        }

        .mr-20-t {
            margin-top: 20px;
        }

        .mr-30-r {
            margin-right: 30px;
        }

        .mr-30-l {
            margin-left: 30px;
        }

        .box-vehicle {
            width: 90px;
            padding: 10px;
            border: #114b93 1px solid;
            margin: 10px;
            height: 80px;
        }

        .box-price {
            width: 350px;
            padding: 10px;
            border: black 1px solid;
            margin: 10px;
            height: 150px;
        }

        .mr-2 {
            margin-right: 2px;
        }

        .mr-r-2 {
            margin-right: 2px;
        }

        .bg-white {
            background-color: white;
        }

        .p-10 {
            padding: 10px;
        }
    </style>
    {{-- Modal for Customer Select --}}
    <div id="myModal" class="modal">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Select a Customer</h3>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    @foreach ($customers as $customer)
                        <div class="customer-field" style="padding:5px"
                            onclick="CustomerSelected({{ $customer->id }}, '{{ $customer->first_name }} {{ $customer->last_name }}', '{{ $customer->home_address }}', '{{ $customer->office_address }}');">
                            <div class="row">
                                <div class="col-md-6">{{ $customer->first_name }} {{ $customer->last_name }}</div>
                                <div class="col-md-6" style="word-break: break-all">{{ $customer->email }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" charset="utf-8">
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function showPopup() {
            modal.style.display = "block";
        }
    </script>
    
    {{-- Title --}}
    <form method="POST" action="{{route('store_step_one')}}"  >
        @csrf
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Create Booking</span>
        </div>
    </div>
    {{-- Customer Line Input --}}
    <div class="px-4 row">
        <div class="col-md-12">
            <span class="font-weight-bold">Customer</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <div class="px-4 row">
        <div class="col-md-12 autocomplete"> 
                <input class="border-none background-white-50 outline-none customInputWidth getDataType" id="search" name="customer" data-type="client" placeholder="Type name" style="width:90%"  required />    
            <label for="customer">
                <span onclick="showPopup();"><i class="fa fa-user"></i></span>
            </label>
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>

    {{-- Date Select --}}
    <div class="px-4 row">
        <div class="col-md-12">
            <div class="wrapper p-2"></div>
            <span class="font-weight-bold">Date and Time</span>
            <div class="py-3" id="date_selector">
                @if (isset($previousData['date']) && $previousData['date'] == $today->format('Y-m-d'))
                <div data-value="{{ $today->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected">Today, <?php echo $today->format('F, d, Y'); ?></div>
            @elseif(!isset($previousData['date']))
                <div data-value="{{ $today->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected">Today, <?php echo $today->format('F, d, Y'); ?></div>
            @else
                <div data-value="{{ $today->format('Y-m-d') }}" class="wrapper py-3 pl-2 font80 calendar-day">Today,
                    <?php echo $today->format('F, d, Y'); ?></div>
            @endif

            @if (isset($previousData['date']) && $previousData['date'] == $tomorrow->format('Y-m-d'))
                <div data-value="{{ $tomorrow->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected">Tomorrow, <?php echo $tomorrow->format('F, d, Y'); ?>
                </div>
            @else
                <div data-value="{{ $tomorrow->format('Y-m-d') }}" class="wrapper py-3 pl-2 font80 calendar-day">
                    Tomorrow, <?php echo $tomorrow->format('F, d, Y'); ?></div>
            @endif

            @if (isset($previousData['date']) && $previousData['date'] == $date3->format('Y-m-d'))
                <div data-value="{{ $date3->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected"><?php echo $date3->format('l, F, d, Y'); ?></div>
            @else
                <div data-value="{{ $date3->format('Y-m-d') }}" class="wrapper py-3 pl-2 font80 calendar-day">
                    <?php echo $date3->format('l, F, d, Y'); ?></div>
            @endif

            @if (isset($previousData['date']) && $previousData['date'] == $date4->format('Y-m-d'))
                <div data-value="{{ $date4->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected"><?php echo $date4->format('l, F, d, Y'); ?></div>
            @else
                <div data-value="{{ $date4->format('Y-m-d') }}" class="wrapper py-3 pl-2 font80 calendar-day">
                    <?php echo $date4->format('l, F, d, Y'); ?></div>
            @endif

            @if (isset($previousData['date']) && $previousData['date'] == $date5->format('Y-m-d'))
                <div data-value="{{ $date5->format('Y-m-d') }}"
                    class="wrapper py-3 pl-2 font80 calendar-day calendar-day-selected"><?php echo $date5->format('l, F, d, Y'); ?></div>
            @else
                <div data-value="{{ $date5->format('Y-m-d') }}" class="wrapper py-3 pl-2 font80 calendar-day">
                    <?php echo $date5->format('l, F, d, Y'); ?></div>
            @endif
                <label class="control-label font80 py-2">Select another date</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" id="other_date" value="" name="date" required />
                    <span class="input-group-addon">
                        <label for="other_date"><span class="glyphicon glyphicon-calendar"></span></label>
                    </span>
                </div>
            </div>
        </div>
    </div>  
    {{-- Time Select --}}
    <div class="px-4" id="time_selector">
        <div class="px-4 row">
            <div class="col-md-5">
                {{-- <div class="row">
                    <div class="col-md-4 px-0 py-2 text-center">
                        <label class="custom-radio-label">
                            <input type="radio" class="custom-radio-input" name="number" value="1">
                            <span class="custom-radio-checkmark" data-number="01"></span>
                          </label>
                    </div>
                </div> --}}

                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo '<div class="row">';
                    for ($j = 0; $j < 3; $j++) {
                        $time = $i * 3 + $j + 1;
                        $string = str_pad($time, 2, '0', STR_PAD_LEFT);
                
                        echo '<div class="col-md-4 px-0 py-2 text-center">
                                <label class="custom-radio-label">
                                    <input type="radio" class="custom-radio-input" name="hour" value="' . $time . '" required>
                                    <span class="custom-radio-checkmark" data-number="' . $string . '"></span>
                                </label>
                              </div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <div class="col-md-2" style="align-self:center;">
                <div class="row">
                        <div class="col-md-12 px-0 py-2 text-center">
                            <label class="custom-radio-label">
                                <input type="radio" class="custom-radio-input" name="ampm" value="AM" required>
                                <span class="custom-radio-checkmark" data-number="am"></span>
                            </label>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12 px-0 py-2 text-center">
                        <label class="custom-radio-label">
                            <input type="radio" class="custom-radio-input" name="ampm" value="PM
                            " required>
                            <span class="custom-radio-checkmark" data-number="pm"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo '<div class="row">';
                    for ($j = 0; $j < 3; $j++) {
                        $time = $i * 3 + $j;
                        $string = str_pad($time * 5, 2, '0', STR_PAD_LEFT);
                
                        echo '<div class="col-md-4 px-0 py-2 text-center">
                                <label class="custom-radio-label">
                                    <input type="radio" class="custom-radio-input" name="minute" value="' . $string . '" required>
                                    <span class="custom-radio-checkmark" data-number="' . $string . '"></span>
                                </label>
                              </div>';
                    }
                    echo '</div>';
                }
                ?>  
            </div>
        </div>
    </div>

    {{-- Ride Details --}}
    <div class="p-4 row">
        <div class="col-md-12">
            <span class="font-weight-bold">Ride Details</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <div class="px-4 pt-3 row">
        <div class="col-md-6 autocomplete">
                <input class="wrapper border-none background-white-50 outline-none  getDataType" name="passenger_name" id="passenger_name" placeholder="Passenger's name" data-type="passenger" />       
        </div>
        <div class="col-md-6" id="customer_is_passenger" style="display: none">
                <div style="display:flex;">
                    <input type="checkbox"  checked="checked" class="mr-2" name="is_passenger" onchange="" value="1">
                    <p class="mr-20-t">Customer is also passenger</p>
                </div>
            </div>
    </div>
    <div class="px-4 pt-3 row">
        <div class="col-md-6 autocomplete">
                <input class="wrapper border-none background-white-50 outline-none" type="tel" name="passenger_phone" placeholder="Passenger's phone#" oninput="formatAllPhoneNumbers(this); minlength="10" type="text" />
            <div class="stroke-line wrapper pb-5"></div>
        </div>
        <div class="col-md-6">
            <input class="wrapper border-none background-white-50 outline-none"  id="flight_no" placeholder="Flight#" name="flight" minlength="10"  oninput="" />
            <div class="stroke-line wrapper pb-5"></div>
        </div>
    </div>
    {{-- Source Address Pick --}}
    <div class="px-4 pt-5 row">
        <div class="col-md-12">
                <input class="border-none background-white-50 outline-none customInputWidth" id="src-address"name="from_location" placeholder="Pick up address" value="" required/>
            <label for="address">
                <span><i class="fa fa-map-marker"></i></span>
            </label>
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-5 py-3 row">
        <div class="col-md-3 px-1">
                <input class="text-center p-2 wrapper mr-10-bt src-address" id="start_home" name="start_home"type="button" value="Home" />
                <input class="text-center p-2 wrapper src-address" id="start_office" name="start_office" type="button"value="Office" />
        </div>
        <div class="col-md-6 px-1 mr-20-t" align="center">
            <input type="checkbox" name="pickup_address_set" id="pickup_address_set_as" onchange="" value="1">
            <p>Set as</p>
        </div>
        <div class="col-md-3 px-1">
                <input class="text-center p-2 wrapper mr-10-bt src-address" id="start_dfw" name="start_dfw" type="button" value="DFW" />
                <input class="text-center p-2 wrapper src-address" id="start_dal" name="start_dal" type="button" value="DAL" />
        </div>
    </div>
    {{-- Destination Address Pick --}}
    <div class="px-4 pt-5 row" id="dst-address-box">
        <div class="col-md-12">
                <input class="border-none background-white-50 outline-none customInputWidth" id="dst-address"name="to_location" placeholder="Destination address" value="" />
            <label for="address">
                <span><i class="fa fa-map-marker"></i></span>
            </label>
            <div class="wrapper p-2"></div>
            <div class="stroke-line wrapper"></div>
        </div>
    </div>
    <div class="px-5 py-3 row" id="dst-address-box-2">
        <div class="col-md-3 px-1">
                <input class="text-center p-2  mr-10-bt wrapper dst-address" id="dest_home" name="dest_home" type="button" value="Home" />
                <input class="text-center p-2 wrapper dst-address" id="dest_office" name="dest_office" type="button"value="Office" />
        </div>
        <div class="col-md-6 px-1 mr-20-t" align="center">
                <input type="checkbox" name="destination_address_set"  id="destination_address_set_as" onchange="" value="1">
            <p>Set as</p>
        </div>
        <div class="col-md-3 px-1">
                <input class="text-center  mr-10-bt p-2 wrapper dst-address" id="dest_dfw" name="dest_dfw"type="button" value="DFW" />          
                <input class="text-center p-2 wrapper dst-address" id="dest_dal" name="dest_dal" type="button"value="DAL" />
        </div>
    </div>
    <div class="px-4 row mr-20-t">
        <div class="col-md-6">
                <input class="text-center p-4 wrapper ride-button" id="ride_transfer" name="ride_transfer"type="button" value="Transfer" />
        </div>
        <div class="col-md-6">
                <input class="text-center p-4 wrapper ride-button" id="ride_hourly" name="ride_hourly" type="button"value="Hourly" />
        </div>
    </div>
    {{-- Duration Set --}}
    <div class="px-4 pt-4 row duration_box" style="display:none;">
        <div class="col-md-4 py-3">
            <span class="font-weight-bold">Duration</span>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 text-right p-3"><i class="fa fa-minus" onclick=""></i></div>
                <div class="col-md-6 text-center">
                        <input class="border-none p-3 background-white outline-none customInputWidth text-center"
                            type="number" min="1" max="999" name="duration" value=""
                            id="duration" onchange="" />
                </div>
                <div class="col-md-3 text-left p-3"><i class="fa fa-plus" onclick=""></i></div>
            </div>
        </div>
    </div>

    {{-- Vehicle Selector --}}
    <div class="px-4 pt-5 row">
        <div class="col-md-12">
            <span class="font-weight-bold">Vehicles</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <?php for ($i = 0; $i < count($vehicle_categories); $i++) {?>
        @if ($i % 3 == 0)
            <div class="px-5 pt-3 row">
        @endif
    
        <div class="col-md-4 px-0 py-2 text-center">
            <label class="custom-radio-label">
                <input type="radio" class="custom-radio-input" name="vehicle_category" 
                value="{{ $vehicle_categories[$i]->id }}" 
                data-price-per-mile="{{ $vehicle_categories[$i]->price_per_mile }}"
                data-price-per-hour="{{ $vehicle_categories[$i]->price_per_hour }}"
                required>
                <span class="custom-radio-checkmark" >{{ $vehicle_categories[$i]->name }}</span>
            </label>
            <div class="col-md-6 font70 p-0 pl-4 text-center">${{ $vehicle_categories[$i]->price_per_hour }}/h</div>
            <div class="col-md-6 font70 p-0 pr-4 text-center">${{ $vehicle_categories[$i]->price_per_mile }}/mi</div>
        </div>
        @if ($i % 3 == 2 || $i == count($vehicle_categories) - 1)   
            </div>
        @endif
    <?php } ?>
    
    {{-- Passengers --}}
    <div class="px-4 pt-5 row">
        <div class="col-md-12">
            <span class="font-weight-bold">Passengers</span>
            <div class="wrapper p-2"></div>
        </div>
    </div>
    <div class="px-4 pt-3 row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3 text-right p-3"><i class="fa fa-minus" onclick=""></i></div>
                <div class="col-md-6 text-center">
                        <input class="border-none p-3 background-white outline-none customInputWidth text-center"
                            type="number" min="1" max="999" name="passenger" id="passenger" required />
                </div>
                <div class="col-md-3 text-left p-3"><i class="fa fa-plus" onclick="PassengerPlus();"></i></div>
            </div>
        </div>
    </div>
    <!-- Calculate price -->
    <div class="px-4 pt-3 row">
        <div class="box-price">
            <div style="display:flex;">
                    <input type="radio" checked="checked" class="mr-2 calculate_price" name="calculate_price" data-type="calculated" />
                    <p class="mr-20-t mr-30-r">Calculated price</p>
                    <span class="mr-20-t mr-30-l" id="price"> $0</span>
            </div>
            <div style="display:flex;">
                    <input type="radio" class="mr-2 calculate_price" name="calculate_price" data-type="manual" />
                    <p class="mr-20-t mr-30-r">Manual price</p>
                    <input placeholder="Price" name="manual_price" id="manual_price" type="number" step="0.01" />
            </div>
            <div style="display:flex;">
                    <input class="text-center p-4 wrapper selectable-button-selected" style="color:white;margin-top:10px" id="booking_re_calculate"
                        name="Calculate" type="button" value="Calculate" onclick="calculateDistance()" />
            </div>
        </div>
    </div>
    <!-- New customers only -->
    {{-- <div class="p-4 row" id="new_customer_details">
        <div class="bg-white p-10">
            <div class="col-md-12" align="center">
                <span class="font-weight-bold">For new customers only</span>
                <div class="wrapper p-2"></div>
            </div>
            <div class="px-4 pt-3 row">
                <div class="col-md-12 autocomplete">
                    <input class="wrapper border-none bg-white outline-none customInputWidth getDataType"
                        placeholder="Email" name="new_customer_email" id="new_customer_email" type="email"  oninput=""/>
                    <div class="wrapper p-2"></div>
                    <div class="stroke-line wrapper"></div>

                </div>
                <div class="col-md-12 autocomplete">
                    <input onkeypress="" class="wrapper border-none bg-white outline-none customInputWidth getDataType"
                        placeholder="Phone" type="text" name="new_customer_phone" id="new_customer_phone" oninput="formatAllPhoneNumbers(this); />
                    <div class="wrapper p-2"></div>
                    <div class="stroke-line wrapper"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Next --}}   
        <div id="VariationAlert">
            Complete The Form Please!
        </div>

        <div class="px-4 py-5 row">
            <div class="col-md-12">
                <input class="text-center p-4 wrapper selectable-button-selected" style="color:white;" id="booking_next_step"
                    name="next" type="submit" value="Next" />
            </div>
        </div>
    </form>

    <script>
    function calculateDistance() {
    var origin = document.getElementById('src-address').value;
    var destination = document.getElementById('dst-address').value;
    var selectedOption = document.querySelector('input[name="vehicle_category"]:checked');
    var hour = document.getElementById('duration');
    
    if (selectedOption) {
        var pricePerMile = parseFloat(selectedOption.getAttribute('data-price-per-mile'));
        var pricePerHour = parseFloat(selectedOption.getAttribute('data-price-per-hour'));

        if(hour.value.trim() != ''){
            var price = hour.value * pricePerHour;
            document.getElementById('price').innerHTML = 'Prix: $' + price.toFixed(2);
            document.getElementById('manual_price').value = price.toFixed(2);
        }
        else{
            var service = new google.maps.DistanceMatrixService();

            service.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.IMPERIAL,
            }, function(response, status) {
                if (status === 'OK' && response.rows.length > 0 && response.rows[0].elements.length > 0) {
                    var distanceText = response.rows[0].elements[0].distance.text;
                    var distanceValue = parseFloat(distanceText.replace(" mi", ""));

                    var duration = response.rows[0].elements[0].duration.text;

                    var price = distanceValue * pricePerMile;
                    document.getElementById('price').innerHTML = 'Prix: $' + price.toFixed(2);
                    document.getElementById('manual_price').value = price.toFixed(2);
                } else {
                    document.getElementById('result').innerHTML = 'Impossible de calculer la distance.';
                }
            });
        }
    } else {
        console.error('Aucune option sélectionnée.');
    }
}


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyATQgdZ12KKj6Kty5bJS90dnB9BUNEYnYg&sensor=false&libraries=places&callback=initAutocomplete&types=airport"></script>
@endsection
