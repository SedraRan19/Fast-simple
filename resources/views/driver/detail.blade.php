
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<style>
    .error{
        color:red;
        margin:10px;
        cursor: pointer !important;
    }
    .model-head{
        background-color:#f8f8f8 !important;
    }
    .model-content-custom{
        background-color:#f8f8f8 !important;
    }
</style>
@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Driver</span>
        </div>
    </div>
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
            <div class="px-4 py-2 pt-4 row">
                <div class="col-md-8"><h4 style="margin-top:8px;">Vehicle Category</h4></div>
                <div class="col-md-2">
                    <button type="button" class="back-sky color-white border-radius-30 add_button" data-toggle="modal" data-target="#exampleModal" >
                        <i class="fa fa-plus p-3 float-right back-sky text-white border-radius-30"></i>
                    </button>
                </div>
            </div>
            <div id="list_dvc">
            {{-- DRIVER VEHICLE CATEGORY       --}}
            </div>
        </div>
      

@include('driver.modals.create_dvc')
@include('driver.modals.edit_dvc')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
$.ajax({
    url: "{{ route('list_detail_driver',['id'=>$driver->id]) }}",
    method: 'GET',
    success: function(data) {
        // Manipulation des données reçues
        $('#list_dvc').empty().html(data);
    },
    error: function(xhr) {
        // Gestion des erreurs
        console.log(xhr.responseText);
    }
    });

    $(document).on('click', '.view_details', function () {
    var id = $(this).data('id');
    var vehicle_category_id = $(this).data('vehicle_category_id');
    var price_per_hour = $(this).data('price_per_hour');
    var price_per_mile = $(this).data('price_per_mile');
    var base_price = $(this).data('base_price');
    var included = $(this).data('included');
    var percentage = $(this).data('percentage');
    var payout_calculation = $(this).data('payout_calculation');
    if (payout_calculation === 0) {
        $('#default_payout_percentage').prop('checked', false);
        $('#hourly_miles').prop('checked', true);
    } else {
        $('#hourly_miles').prop('checked', false);
        $('#default_payout_percentage').prop('checked', true);
    }
    console.info(id);
    $('#id').val(id);
    $('#vehicle_category_id').val(vehicle_category_id);
    $('#price_per_hour').val(price_per_hour);
    $('#price_per_mile').val(price_per_mile);
    $('#base_price').val(base_price);
    $('#included').val(included);
    $('#percentage').val(percentage);
    $('#payout_calculation').text('Update');
});

</script>
