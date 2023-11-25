@extends('layouts.app')
@section('content')
    {{-- Title --}}
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Trips </span>
        </div>
    </div>
    {{-- Customer Line Input --}}
    <div class="row py-2">
        <div class="col-md-8">
            <input class="wrapper border-radius-10 p-3 background-white outline-none" name="search" type="search"
                placeholder="Search" id="search_trip"/>
        </div>
        <div class="col-md-2"><a href="javascript:void(0);" onclick="paid()" class="all_drivers">Paid</a></div>
        <div class="col-md-2"><a href="javascript:void(0);" onclick="unpaid()" class="pending_drivers">Unpaid</a></div>
    </div>
    <div class="row py-2">
        <div class="col-md-12">
            <div class="col-md-6">
                <button onclick="upcoming()" class="text-center wrapper selectable-button-selected px-3 py-1 mt-4 color-white">Trip upcoming</button>
            </div>
            <div class="col-md-6">
                <button onclick="history()" class="text-center wrapper selectable-button-selected px-3 py-1 mt-4 color-white">Trip History</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 py-2" id="trip_list">
                {{-- TRIPS LIST --}}
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $.ajax({
        url: "{{ route('trip_list') }}",
        method: 'GET',
        success: function(data) {
            // Manipulation des données reçues
            $('#trip_list').empty().html(data);
        },
        error: function(xhr) {
            // Gestion des erreurs
            console.log(xhr.responseText);
        }
        });

        function upcoming(){
            $.ajax({
            url: "{{ route('trip_upcoming_list') }}",
            method: 'GET',
            success: function(data) {
                // Manipulation des données reçues
                $('#trip_list').empty().html(data);
            },
            error: function(xhr) {
                // Gestion des erreurs
                console.log(xhr.responseText);
            }
            });
        }

        function history(){
            $.ajax({
            url: "{{ route('trip_history_list') }}",
            method: 'GET',
            success: function(data) {
                // Manipulation des données reçues
                $('#trip_list').empty().html(data);
            },
            error: function(xhr) {
                // Gestion des erreurs
                console.log(xhr.responseText);
            }
            });
        }

        function paid(){
            $.ajax({
            url: "{{ route('trip_paid_list') }}",
            method: 'GET',
            success: function(data) {
                // Manipulation des données reçues
                $('#trip_list').empty().html(data);
            },
            error: function(xhr) {
                // Gestion des erreurs
                console.log(xhr.responseText);
            }
            });
        }

        function unpaid(){
            $.ajax({
            url: "{{ route('trip_unpaid_list') }}",
            method: 'GET',
            success: function(data) {
                // Manipulation des données reçues
                $('#trip_list').empty().html(data);
            },
            error: function(xhr) {
                // Gestion des erreurs
                console.log(xhr.responseText);
            }
            });
        }

        $(document).ready(function() {
            $('#search_trip').on('input', function(event) {
                event.preventDefault(); // Empêche le formulaire de se soumettre normalement

                var formData = $(this).serialize(); // Récupère les données du formulaire
                var url = "{{ route('search_trip') }}";
                $.ajax({
                url: url,
                method: 'GET',
                data: formData,
                success: function(data) {
                    // Manipulation des données reçues
                    $('#trip_list').empty().html(data);
                },
                error: function(xhr) {
                    // Gestion des erreurs
                    console.log(xhr.responseText);
            }
            });
        });
        });
    
</script>
