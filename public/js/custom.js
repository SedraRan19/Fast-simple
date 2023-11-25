window.onresize = function () {
    var mydiv = document.querySelector("#mydiv");
    mydiv.style.minHeight = window.screen.height + "px";
};

window.onload = function () {
    var mydiv = document.querySelector("#mydiv");
    mydiv.style.minHeight = window.screen.height + "px";
};

function openNav() {
    document.getElementById("mySidenav").style.width =
        document.getElementById("innerSidenav").clientWidth + "px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function formatAllPhoneNumbers(obj) {
    var txt = $(obj).val();
    var formated;
    if (txt.length == 10) formated = formatPhoneNumber(txt);
    else formated = txt;
    $(obj).val(formated);
}


// delete functions

$('.delete-record').on('click', function (e) {
    e.preventDefault();
    var $current = $(this); // <- save the clicked button to a variable
    swal({
        title: `Are you sure you want to delete this record?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('route'),
                    data: {
                        _method: 'DELETE'
                    },
                    success: function (data) {

                        if (data == "You cannot delete this driver as bookings are present") {
                            toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": 'toast-bottom-center'
                            }
                            toastr.error(data);
                        } else {
                            $current.closest('.record_block').remove();
                            toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": 'toast-bottom-center'
                            }
                            toastr.success('Record Deleted Successfully');
                        }

                    },
                });
            }
        });
});

function searchForRecord(obj) {
    console.info(obj);
    var filter = $(obj).val();
    filter = $.trim(filter.toUpperCase());

    var filter, i, txtValue, list;
    list = document.getElementsByClassName("record_block");
    for (i = 0; i < list.length; i++) {
        txtValue = $.trim(list[i].getAttribute("data-param1"));
        txtValue2 = $.trim(list[i].getAttribute("data-param2"));
        txtValue3 = $.trim(list[i].getAttribute("data-param3"));
        txtValue4 = $.trim(list[i].getAttribute("data-param4"));
        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
            list[i].style.display = "block";
        } else {
            list[i].style.display = "none";
        }
    }
}

function loadPreview(input) {
    var data = $(input)[0].files; //this file data
    $.each(data, function (index, file) {
        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
            var fRead = new FileReader();
            fRead.onload = (function (file) {
                return function (e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                    $('#thumb-output').append(img);
                };
            })(file);
            fRead.readAsDataURL(file);
        }
    });

}

function searchCustomers(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: customerDetailsUrl,
        type: 'get',
        data: { 'id': id },
        dataType: 'json',
        success: function (response) {
            console.log('response' + response);
            if (response != null) {
                console.log(response);
                if (response.office_address == 'Not Specified') {
                    $('#src-address').val('');
                    $('#dst-address').val('');
                    $('#start_office').attr('disabled', 'disabled').removeClass('src-address-selected').addClass('disBtn');
                    $('#dest_office').attr('disabled', 'disabled').removeClass('dst-address-selected').addClass('disBtn');
                }
                else {
                    $('#start_office').removeClass('disBtn').removeAttr('disabled');
                    $('#dest_office').removeClass('disBtn').removeAttr('disabled');
                }

                if (response.home_address == 'Not Specified') {
                    $('#src-address').val('');
                    $('#dst-address').val('');
                    $('#start_home').attr('disabled', 'disabled').removeClass('src-address-selected').addClass('disBtn');
                    $('#dest_home').attr('disabled', 'disabled').removeClass('dst-address-selected').addClass('disBtn');
                }
                else {
                    $('#start_home').removeClass('disBtn').removeAttr('disabled');
                    $('#dest_home').removeClass('disBtn').removeAttr('disabled');
                }

                $('#form-data-customer-id').val(response.id);
                $("#form-data-customer-name").val(response.first_name + ' ' + response.last_name);
                $('#passenger_name').val(response.first_name + ' ' + response.last_name);
                $('#form-data-passenger-name').val(response.first_name + ' ' + response.last_name);
                $('#form-data-passenger-phone').val(response.phone);
                $('#passenger_phone').val(response.phone);
            }
        }
    });
}


function checkCustomerValue(obj) {
    if ($(obj).val() != '') {
        $('#form-data-customer-id').val('');
        $("#form-data-customer-name").val('');
        $('#passenger_name').val('');
        $('#form-data-passenger-name').val('');
        $('#form-data-passenger-phone').val('');
        $('#passenger_phone').val('');
        $("#new_customer_email").prop('disabled', false);
        $("#new_customer_phone").prop('disabled', false);
        $("#new_customer_details").show();
        $("#customer_is_passenger").hide();

        if ($("#form-data-customer-id").val() == '') {
            $("#form-data-customer-name").val($(obj).val());
        }

    }
}

$(".calendar-day").click(function () {
    $(".calendar-day").removeClass("calendar-day-selected");
    $("#datetimepicker1").removeClass("dateInput-selected");
    $(this).addClass("calendar-day-selected");
    // $("#form-data-date").val($(this).text());
    $('#other_date').val($(this).attr('data-value'))
    $('#form-data-date').val($(this).attr('data-value'))
    0
});

$(".ride-button").click(function () {
    $(".ride-button").removeClass("ride-selected");
    $(this).addClass("ride-selected");
    if ($(this).val() == "Hourly") {
        $(".duration_box").fadeIn("slow");
        $("#dst-address-box").fadeOut("slow");
        $("#dst-address-box-2").fadeOut("slow");
    } else {
        $(".duration_box").fadeOut("slow");
        $("#dst-address-box").fadeIn("slow");
        $("#dst-address-box-2").fadeIn("slow");
    }
    $("#form-data-ride").val($(this).val());
    calculateBookingCharge();
});

function GetCustomerIndexFormId(id) {
    for (var i = 0; i < CustomerData.length; i++) {
        if (CustomerData[i].id == id) return i;
    }
    return -1;
}

$(".src-address").click(function () {
    $(".src-address").removeClass("src-address-selected");
    $(this).addClass("src-address-selected");
    var text = $(this).val();
    var customerId = $("#form-data-customer-id").val();

    if (text == "Home" || text == "Office") {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: customerDetailsUrl,
            type: 'get',
            data: { 'id': customerId },
            dataType: 'json',
            success: function (response) {
                if (response != null) {
                    if (text == "Home") {
                        $("#src-address").val(response.home_address);
                        $("#form-data-src-address").val(response.home_address);
                    }

                    if (text == "Office") {
                        $("#src-address").val(response.office_address);
                        $("#form-data-src-address").val(response.office_address);
                    }
                }
            }
        });

    } else {
        if (text == "DFW") {
            $("#src-address").val("DFW International Airport (DFW)");
            $("#form-data-src-address").val("DFW International Airport (DFW)");
        }

        if (text == "DAL") {
            $("#src-address").val("Dallas Love Field Airport (DAL)");
            $("#form-data-src-address").val("Dallas Love Field Airport (DAL)");
        }
    }
    $("#form-data-src-address-t").val($(this).val());

});

$(".dst-address").click(function () {
    $(".dst-address").removeClass("dst-address-selected");
    $(this).addClass("dst-address-selected");
    var text = $(this).val();
    var customerId = $("#form-data-customer-id").val();
    // var customerId = GetCustomerIndexFormId(
    //     $("#form-data-customer-name").val()
    // );
    // console.log('aaa ' + customerId);
    // if (text == "Home" && customerId != -1) {
    //     $("#dst-address").val(CustomerData[customerId].home_address);
    //     $("#form-data-dst-address").val(CustomerData[customerId].home_address);
    // }
    // else if (text == "Office" && customerId != -1) {
    //     $("#dst-address").val(CustomerData[customerId].office_address);
    //     $("#form-data-dst-address").val(
    //         CustomerData[customerId].office_address
    //     );
    // }
    if (text == "Home" || text == "Office") {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: customerDetailsUrl,
            type: 'get',
            data: { 'id': customerId },
            dataType: 'json',
            success: function (response) {
                if (response != null) {
                    if (text == "Home") {
                        $("#dst-address").val(response.home_address);
                        $("#form-data-dst-address").val(response.home_address);
                    }

                    if (text == "Office") {
                        $("#dst-address").val(response.office_address);
                        $("#form-data-dst-address").val(response.office_address);
                    }
                }
            }
        });

    } else if (text == "DFW") {
        $("#dst-address").val("DFW International Airport (DFW)");
        $("#form-data-dst-address").val("DFW International Airport (DFW)");
    }
    else if (text == "DAL") {
        $("#dst-address").val("Dallas Love Field Airport (DAL)");
        $("#form-data-dst-address").val("Dallas Love Field Airport (DAL)");
    }
    $("#form-data-dst-address-t").val(text);
});


$(".vehicle-cell").click(function () {
    $(".vehicle-cell").removeClass("vehicle-selected");
    $(this).addClass("vehicle-selected");
    $("#form-data-vehicle").val($(this).attr("idinfo"));
    calculateBookingCharge();
});

$(".time-cell").click(function () {
    $(".time-cell").removeClass("time-cell-selected");
    $(this).addClass("time-cell-selected");
    $("#form-data-hour").val($(this).text());
});

$(".timetype-cell").click(function () {
    $(".timetype-cell").removeClass("timetype-selected");
    $(this).addClass("timetype-selected");
    $("#form-data-time-t").val($(this).text());
});

$(".minute-cell").click(function () {
    $(".minute-cell").removeClass("minute-selected");
    $(this).addClass("minute-selected");
    $("#form-data-minute").val($(this).text());
});

function DurationPlus() {
    var val = $("#duration").val();
    val++;
    if (val > 999) val = 999;
    $("#duration").val(val);
    $("#form-data-duration").val(val);
    calculateBookingCharge();
}

function DurationMinus() {
    var val = $("#duration").val();
    val--;
    if (val < 0) val = 0;
    $("#duration").val(val);
    $("#form-data-duration").val(val);
    calculateBookingCharge();
}

function PassengerMinus() {
    var val = $("#passenger").val();
    val--;
    if (val < 1) val = 1;
    $("#passenger").val(val);
    $("#form-data-passenger-count").val(val);
}

function PassengerPlus() {
    var val = $("#passenger").val();
    val++;
    if (val > 999) val = 999;
    $("#passenger").val(val);
    $("#form-data-passenger-count").val(val);
}

function PassengerChanged(obj) {
    $("#form-data-passenger-count").val($(obj).val());
    calculateBookingCharge();
}

function DurationChanged(obj) {
    $("#form-data-duration").val($(obj).val());
    calculateBookingCharge();
}

function PassengerNameChanged(obj) {
    $("#form-data-passenger-name").val($(obj).val());
    if ($("#form-data-customer-id").val() == '') {
        //$("#form-data-customer-name").val($(obj).val());
    }
}

function PassengerPhoneChanged(obj) {
    var txt = $(obj).val();
    var formated;
    if (txt.length == 10) formated = formatPhoneNumber(txt);
    else formated = txt;
    $(obj).val(formated);
    $("#form-data-passenger-phone").val(formated);
}

function formatPhoneNumber(phoneNumberString) {
    var cleaned = ("" + phoneNumberString).replace(/\D/g, "");
    var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
    if (match) {
        return "+1(" + match[1] + ") " + match[2] + "-" + match[3];
    }
    return null;
}

function DateChanged() {
    $(".calendar-day").removeClass("calendar-day-selected");
    $("#datetimepicker1").addClass("dateInput-selected");
    $("#form-data-date").val($("#other_date").val());
}

function SourceAddressChanged(obj) {
    setTimeout(function () {
        $("#form-data-src-address").val($(obj).val());
    }, 500);
}

function DestAddressChanged(obj) {
    setTimeout(function () {
        $("#form-data-dst-address").val($(obj).val());
    }, 500);
}

function CustomerSelected(id, name, home, office) {
    $("#search").val(name);
    $("#form-data-customer-name").val(name);
    $("#form-data-customer-name").val(id);
    var modal = document.getElementById("myModal");
    $("#new_customer_email").prop('disabled', true);
    $("#new_customer_phone").prop('disabled', true);
    $("#new_customer_details").hide();
    $("#customer_is_passenger").show();
    modal.style.display = "none";
}

function CustomerIsPassengerChanged(obj) {
    if (obj.checked) {
        $("#form-data-customer-is-checked").val('true');
    } else {
        $("#form-data-customer-is-checked").val('false');
    }
}

function disclaimerCheckedChanged(obj) {
    if (obj.checked) {
        $("#disclaimer_div").show();
    } else {
        $("#disclaimer_div").hide();
    }
}

function destinationSetAsChanged(obj) {
    if (obj.checked) {
        $("#form_data-destination-address-set-as").val('true');
    } else {
        $("#form_data-destination-address-set-as").val('false');
    }
}

function pickupSetAsChanged(obj) {
    if (obj.checked) {
        $("#form_data-pickup-address-set-as").val('true');
    } else {
        $("#form_data-pickup-address-set-as").val('false');
    }
}

function setBookingCost(obj) {
    $("#form-data-booking-cost").val($(obj).val());
}

function flightNumberChanged(obj) {
    $("#form-data-flight-number").val($(obj).val());
}

function newCustomerEmailChanged(obj) {
    $("#form-data-new-customer-email").val($(obj).val());
}

function newCustomerPhoneChanged(obj) {
    formatAllPhoneNumbers(obj);
    $("#form-data-new-customer-phone").val($(obj).val());
}

$('.calculate_price').click(function () {
    $('.calculate_price').not(this).prop('checked', false);
    $('#form-data-payment-type').val($(this).attr('data-type'));
    if ($(this).attr('data-type') == 'manual') {
        $("#manual_price").removeAttr('disabled');
    } else {
        $("#manual_price").attr('disabled', true);
    }
});



$('#search').typeahead({
    source: function (query, process) {
        return $.get(customerSearchUrl, {
            query: query
        }, function (data) {
            return process(data);
        });
    },
    afterSelect: function (item) {
        $("#form-data-customer-name").val(item.name);
        $("#form-data-customer-id").val(item.id);
        $("#search").val(item.name);
        $("#new_customer_email").prop('disabled', true);
        $("#new_customer_phone").prop('disabled', true);
        $("#new_customer_details").hide();
        $("#customer_is_passenger").show();
        searchCustomers(item.id);
    }
});


// function calculateBookingCharge() {

//     console.log('method executed');
//     var from_address = $("#form-data-src-address").val();
//     var to_address = $("#form-data-dst-address").val();
//     var duration = $("#form-data-duration").val();
//     var passenger_count = $("#form-data-passenger-count").val();
//     var ride_type = $("#form-data-ride").val();
//     var vehicle_category = $("#form-data-vehicle").val();

//     if (from_address != '' && ride_type != '' && vehicle_category != '') {
//         $("#snackbar").addClass('show');
//     }

//     $.ajax({
//         type: "POST",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: 'json',
//         data: { 'from_address': from_address, 'to_address': to_address, 'duration': duration, 'passenger_count': passenger_count, 'ride_type': ride_type, 'vehicle_category': vehicle_category },
//         url: bookingCostUrl,
//         success: function (data) {
//             if (data.calcPrice) {
//                 $("#calculated_price").text('$' + data.calcPrice);
//                 $("#form-data-booking-cost").val(data.calcPrice);
//             }
//             if (data.time) {
//                 $("#form-data-booking-time").val(data.time);
//             }
//             if (data.distance) {
//                 $("#form-data-booking-distance").val(data.distance);
//             }
//             $("#snackbar").removeClass('show');
//         },
//     });
// }

google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
    var from_place_input = document.getElementById('src-address');
    var autocomplete = new google.maps.places.Autocomplete(from_place_input);
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place);
        $("#form-data-src-address").val(place.formatted_address);
        calculateBookingCharge();

    });

    var to_place_input = document.getElementById('dst-address');
    var autocomplete_to_address = new google.maps.places.Autocomplete(to_place_input);
    autocomplete_to_address.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place);
        $("#form-data-dst-address").val(place.formatted_address);
        calculateBookingCharge();

    });

    var to_place_input = document.getElementById('home-address');
    var autocomplete_to_address = new google.maps.places.Autocomplete(to_place_input);
    autocomplete_to_address.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place);
        $("#home-address").val(place.formatted_address);
        //calculateBookingCharge();
    });

    var to_place_input = document.getElementById('office-address');
    var autocomplete_to_address = new google.maps.places.Autocomplete(to_place_input);
    autocomplete_to_address.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place);
        $("#office-address").val(place.formatted_address);
        //calculateBookingCharge();
    });
}

$("#bookingForm").submit(function (e) {

    $("#booking_next_step").attr('disabled', true);
    $("#booking_next_step").val('Submitting...');
    var ele = $("#bookingForm :input[required]");
    var success = true;
    var required_fields_name = '';
    var required_fields_name_array = [];
    for (var i = 0; i < ele.length; i++) {
        if (ele[i].value == "") {
            required_fields_name_array.push(ele[i].dataset.label);
            // required_fields_name = required_fields_name + ele[i].dataset.label;
            success = false;
        }
    }
    //console.info(required_fields_name_array);
    if (required_fields_name_array != '') {
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
            "positionClass": 'toast-bottom-center'
        }
        required_fields_name_array.forEach(element => {
            // ...use `element`...
            toastr.error('Please fill or select field ' + element);
        });

        // toastr.error('Please fill or select below fields  <br> ' + required_fields_name);
    }

    if ($("#form-data-customer-id").val() == '') {
        if ($("#form-data-new-customer-email").val() == '' || $("#form-data-new-customer-phone").val() == '') {
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "positionClass": 'toast-bottom-center'
            }
            toastr.error('Please fill Customer Name/Email Fields');
            success = false;
        }
    }
    if ($("#form-data-ride").val() == 'Transfer') {
        if ($("#form-data-dst-address").val() == '') {
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true,
                "positionClass": 'toast-bottom-center'
            }
            toastr.error('Please fill Destination Address');
            success = false;
        }
    }

    if ($("#form-data-duration").val() == '0') {
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true,
            "positionClass": 'toast-bottom-center'
        }
        toastr.error('Duration Should be more than 0');
        success = false;
    }

    if (!success) {
        $("#booking_next_step").attr('disabled', false);
        $("#booking_next_step").val('Next');
    }
    return success;
});

function getTripFilters(filter) {
    filter = $.trim(filter.toUpperCase());
    console.log(filter);
    var filter, i, txtValue, list;
    list = document.getElementsByClassName("record_block");
    for (i = 0; i < list.length; i++) {
        console.log(list[i]);
        txtValue = $.trim(list[i].getAttribute("data-type"));
        console.log(txtValue);
        if (txtValue.toUpperCase() == filter) {
            list[i].style.display = "block";
        } else {
            list[i].style.display = "none";
        }
    }
}
// Driver vehicle category script start

$(document).ready(function () {
    $('#error-display').css('display', 'none');
    $('[data-bs-toggle="tooltip"]').tooltip();
    //$('#pending-payout').hide();
    $('#pending-payout').css('display', 'none');
});


$(document).on('click', '.add_button', function (event) {
    console.info('open model');
    $('#vehicle_category_id').val('');
    $('#price_per_hour').val('');
    $('#price_per_mile').val('');
    $('#base_price').val('');
    $('#miles_included').val('');
    $('#percentage').val('');
    $('#hourly_miles').prop('checked', false); // Unchecks it
    $('#default_payout_percentage').prop('checked', false); // Unchecks it
    $('#save-driver-vehicle').text('Save');
});

var count = 0;

$(document).on('click', '#save-driver-vehicle', function () {
    var error_vehicle_category_id = '';
    var error_price_per_hour = '';
    var vehicle_category_id = '';
    var price_per_hour = '';
    var vehicle_category = '';
    var price_per_mile = '';
    var base_price = '';
    var miles_included = '';
    var percentage = '';
    var hourly_miles = '';
    var default_payout_percentage = '';
    vehicle_category_id = $('#vehicle_category_id').val();
    vehicle_category = $("#vehicle_category_id").find(':selected').attr('data-name');
    price_per_hour = $('#price_per_hour').val();
    price_per_mile = $('#price_per_mile').val();
    base_price = $('#base_price').val();
    miles_included = $('#miles_included').val();
    percentage = $('#percentage').val();
    hourly_miles = $('#hourly_miles').val();
    default_payout_percentage = $('#default_payout_percentage').val();
    var default_payout = '';
    if ($('#hourly_miles').is(':checked')) {
        default_payout = hourly_miles;
    } else if ($('#default_payout_percentage').is(':checked')) {
        default_payout = default_payout_percentage;
    } else {
        default_payout = '';
    }

    if (vehicle_category_id != '' && price_per_hour != '' && price_per_mile != '' && base_price != '' && miles_included != '' && percentage != '' && default_payout != '') {
        //if (vehicle_category_id != '' && percentage != '') {
        // $("#exampleModal .close").click();
        //$('#exampleModal').modal('toggle');
        $('#error-display').css('display', 'none');
        if ($('#save-driver-vehicle').text() == 'Save') {
            var array = { 'vehicle_category': vehicle_category_id, 'price_per_hour': price_per_hour, 'price_per_mile': price_per_mile, 'base_price': base_price, 'miles_included': miles_included, 'percentage': percentage, 'default_payout': default_payout };
            //var array = { 'vehicle_category': vehicle_category_id, 'percentage': percentage };
            var myJsonString = JSON.stringify(array);
            console.info(myJsonString);
            count = count + 1;
            output = '<div class="row" id="row_' + count + '" >';
            output += '<div class="col-md-8"><h4>' + vehicle_category + '</h4><input type="hidden" name="vehicle_category[' + count + ']" id="vehicle_category' + count + '" class="vehicle_category_id" value=' + myJsonString + ' /></div>';
            output += '<input type="hidden" name="vehicle_category_id[' + count + '][]" id="vehicle_category_id' + count + '" class="vehicle_category_id" value=' + vehicle_category_id + ' />';
            output += '<input type="hidden" name="price_per_hour[' + count + '][]" id="price_per_hour' + count + '" class="price_per_hour" value=' + price_per_hour + ' />';
            output += '<input type="hidden" name="price_per_mile[' + count + '][]" id="price_per_mile' + count + '" class="price_per_mile" value=' + price_per_mile + ' />';
            output += '<input type="hidden" name="base_price[' + count + '][]" id="base_price' + count + '" class="base_price" value=' + base_price + ' />';
            output += '<input type="hidden" name="miles_included[' + count + '][]" id="miles_included' + count + '" class="miles_included" value=' + miles_included + ' />';
            output += '<input type="hidden" name="percentage[' + count + '][]" id="percentage' + count + '" class="percentage" value=' + percentage + ' />';
            output += '<input type="hidden" name="hourly_miles[' + count + '][]" id="hourly_miles' + count + '" class="hourly_miles" value=' + hourly_miles + ' />';
            output += '<input type="hidden" name="default_payout_percentage[' + count + '][]" id="default_payout_percentage' + count + '" class="default_payout_percentage" value=' + default_payout_percentage + ' />';
            output += '<input type="hidden" name="default_payout[' + count + '][]" id="default_payout' + count + '" class="default_payout" value=' + default_payout + ' />';
            output += '<div class="col-md-2"><button type="button" class="back-sky p-3 view_details color-white border-radius-30" data-toggle="modal" data-target="#exampleModal" id="' + count + '">Edit</button></div>';
            output += '<div class="col-md-2"><i class="fa fa-times p-2 remove_details color-red" style="font-size:24px;color:red;" id="' + count + '"></i></div>';
            output += '</div>';
            // console.log(output);
            $('#user_data').append(output);
        }
        else {

            var row_id = $('#hidden_row_id').val();
            console.info(row_id);
            var id = $('#row_' + row_id + '').attr('data-id');
            //console.info(vehicle_category);
            var array = { 'id': id, 'vehicle_category': vehicle_category_id, 'price_per_hour': price_per_hour, 'price_per_mile': price_per_mile, 'base_price': base_price, 'miles_included': miles_included, 'percentage': percentage, 'default_payout': default_payout };
            //var array = { 'id': id, 'vehicle_category': vehicle_category_id, 'percentage': percentage };
            var myJsonString = JSON.stringify(array);
            console.info(myJsonString.default_payout);
            output = '<div class="row" id="row_' + count + '">';
            output = '<div class="col-md-8"><h4>' + vehicle_category + '</h4><input type="hidden" name="vehicle_category[' + row_id + ']" id="vehicle_category' + row_id + '" class="vehicle_category_id" value=' + myJsonString + ' /></div>';
            output += '<input type="hidden" name="vehicle_category_id[' + row_id + '][]" id="vehicle_category_id' + row_id + '" class="vehicle_category_id" value=' + vehicle_category_id + ' />';
            output += '<input type="hidden" name="price_per_hour[' + row_id + '][]" id="price_per_hour' + row_id + '" class="price_per_hour" value=' + price_per_hour + ' />';
            output += '<input type="hidden" name="price_per_mile[' + row_id + '][]" id="price_per_mile' + row_id + '" class="price_per_mile" value=' + price_per_mile + ' />';
            output += '<input type="hidden" name="base_price[' + row_id + '][]" id="base_price' + row_id + '" class="base_price" value=' + base_price + ' />';
            output += '<input type="hidden" name="miles_included[' + row_id + '][]" id="miles_included' + row_id + '" class="miles_included" value=' + miles_included + ' />';
            output += '<input type="hidden" name="percentage[' + row_id + '][]" id="percentage' + row_id + '" class="percentage" value=' + percentage + ' />';
            output += '<input type="hidden" name="hourly_miles[' + row_id + '][]" id="hourly_miles' + row_id + '" class="hourly_miles" value=' + hourly_miles + ' />';
            output += '<input type="hidden" name="default_payout_percentage[' + row_id + '][]" id="default_payout_percentage' + row_id + '" class="default_payout_percentage" value=' + default_payout_percentage + ' />';
            output += '<input type="hidden" name="default_payout[' + row_id + '][]" id="default_payout' + row_id + '" class="default_payout" value=' + default_payout + ' />';
            output += '<div class="col-md-2"><button type="button" class="back-sky p-3 view_details color-white border-radius-30" data-toggle="modal" data-target="#exampleModal" id="' + row_id + '">Edit</button></div>';
            output += '<div class="col-md-2"><i class="fa fa-times p-2 remove_details color-red" style="font-size:24px;color:red;" id="' + row_id + '"></i></div>';
            // console.log(output);
            $('#row_' + row_id + '').html(output);
            console.info($('#default_payout' + row_id + '').val());
            $('#vehicle_category_id' + row_id + '').val(vehicle_category_id);
            $('#price_per_hour' + row_id + '').val(price_per_hour);
            $('#price_per_mile' + row_id + '').val(price_per_mile);
            $('#base_price' + row_id + '').val(base_price);
            $('#miles_included' + row_id + '').val(miles_included);
            $('#percentage' + row_id + '').val(percentage);
            if ($('#default_payout' + row_id + '').val() === 'percentage') {
                $('#default_payout_percentage' + row_id + '').prop('checked', true);
            } else {
                $('#hourly_miles' + row_id + '').prop('checked', true);
            }


        }
        $('.modal').removeClass('in');
        $('.modal').attr("aria-hidden", "true");
        $('.modal').css("display", "none");
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    } else {

        $('#error-display').css('display', 'block');
        return false;

    }
});



// $(document).on('click', '.view_details', function () {
//     console.info('yesy');
//     var row_id = $(this).attr("id");
//     var vehicle_category_id = $('#vehicle_category_id' + row_id + '').val();
//     var price_per_hour = $('#price_per_hour' + row_id + '').val();
//     var price_per_mile = $('#price_per_mile' + row_id + '').val();
//     var base_price = $('#base_price' + row_id + '').val();
//     var miles_included = $('#miles_included' + row_id + '').val();
//     var percentage = $('#percentage' + row_id + '').val();
//     var default_payout = $('#default_payout' + row_id + '').val();
//     if (default_payout === 'percentage') {
//         $('#default_payout_percentage').prop('checked', true);
//         $('#hourly_miles').prop('checked', false);
//     } else {
//         $('#hourly_miles').prop('checked', true);
//         $('#default_payout_percentage').prop('checked', false);
//     }
//     $('#vehicle_category_id').val(vehicle_category_id);
//     $('#price_per_hour').val(price_per_hour);
//     $('#price_per_mile').val(price_per_mile);
//     $('#base_price').val(base_price);
//     $('#miles_included').val(miles_included);
//     $('#percentage').val(percentage);
//     $('#hidden_row_id').val(row_id);
//     $('#save-driver-vehicle').text('Update');
// });





$(document).on('click', '.remove_details', function (e) {
    e.preventDefault();
    var $current = $(this); // <- save the clicked button to a variable
    swal({
        title: `Are you sure you want to delete this record?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            var row_id = $(this).attr("id");
            var id = $('#row_' + row_id + '').attr('data-id');
            if (willDelete) {
                $.ajax({
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    url: delete_url + "/" + id,
                    // data: {
                    //     _method: 'DELETE'
                    // },
                    success: function (data) {
                        $('#row_' + row_id + '').remove();
                        $current.closest('.record_block').remove();
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": 'toast-bottom-center'
                        }
                        toastr.success('Driver category Deleted Successfully');
                    },
                });
            }
        });
});

// Driver vehicle category script end

function copyToClipboard(element) {
    //console.info(element);
    var textArea = document.createElement("textarea");
    textArea.value = element;
    document.body.appendChild(textArea);
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        //console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy', err);
    }
    document.body.removeChild(textArea);
}

// Mark as paid for driver ajax call

$(document).on('click', '#driver_payment', function () {
    var driver_id = $(this).attr('data-id');
    var payout = $(this).attr('data-value');

    if (driver_id != null || driver_id != 0) {
        if (payout > 0) {
            $.ajax({
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //dataType: 'json',
                url: driver_payout + "/" + driver_id,
                data: {
                    pending_payout: payout
                },
                success: function (data) {
                    if (data) {
                        $('#pendig_payout').html('$0');
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": 'toast-bottom-center'
                        }
                        toastr.success('Driver Payment Paid Successfully');
                        $("#driver_payment").hide();
                    } else {
                        toastr.error('Something went wrong please try again later');
                    }
                },
            });
        } else {
            toastr.success('There is no payment amount pending so no need to proceed');
        }
    } else {
        toastr.error('Something went wrong please try again later');
    }
});

function deleteCustomerCard(id) {

    swal({
        title: `Alert`,
        text: "Deleting the card will prevent you from charging in this system, but will not delete it from your stripe account?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: delete_card_url,
                    data: { id },
                    success: function (data) {

                        if (data == "Success") {
                            toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": 'toast-bottom-center'
                            }
                            toastr.success('Card Deleted Successfully');
                            var modal = document.getElementById("myModal");
                            modal.style.display = "none";
                            $("#card_" + id).remove();
                        } else {
                            $current.closest('.record_block').remove();
                            toastr.options =
                            {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": 'toast-bottom-center'
                            }
                            toastr.error('Error in Deleting Card');
                        }

                    },
                });
            }
        });

}


// enable driver payout option


function enableDriverPayout(obj) {

    var val = $(obj).val();
    var ride_type = $("#ride_type").val();

    if ($(obj).val() != '') {
        $("#driver_payout").show();

        var postData = { 'driver_id': val, "category_id": $("#vehicle_category_id").val() };

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: get_driver_payout,
            data: postData,
            success: function (data) {
                if (data.default_payout != '') {
                    if (data.default_payout == 'percentage') {
                        $("#driver_payout_selectbox").val('percentage');
                    }

                    if (data.default_payout == 'hourly_miles') {
                        if (ride_type == "Transfer") {
                            $("#driver_payout_selectbox").val('miles');
                        } else {
                            $("#driver_payout_selectbox").val('hourly');
                        }
                    }
                }
            }
        });
    } else {
        $("#driver_payout").hide();
    }

}

// enable driver option





