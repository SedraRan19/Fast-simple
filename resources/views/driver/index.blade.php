@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
                <a href="{{ route('create_driver') }}" class="back-sky color-white" style="z-index:10;"><i
                    class="fa fa-plus p-3 float-right back-sky border-radius-30" style="margin: 15px 20px 0px 0px;"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Driver List</span>
        </div>
    </div>

    <div class="row py-2">
        <div class="col-md-7">
            <form>
                @csrf
            <input class="wrapper border-radius-10 p-3 background-white outline-none" name="search" type="search"
                placeholder="Search" id="search_driver"/>
            </form>
        </div>
        <div class="col-md-1"><a href="javascript:void(0);" class="all_drivers">All</a></div>
        <div class="col-md-4"><a href="javascript:void(0);" class="pending_drivers">Payout Pending</a></div>
    </div>
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
    <div class="row" id="all">
        <div class="col-md-12 py-2" >   
            <div id="driver_list">
            {{-- DRIVER LIST --}}
            
            </div>
        </div>
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
    $.ajax({
        url: "{{ route('driver_list') }}",
        method: 'GET',
        success: function(data) {
            // Manipulation des données reçues
            $('#driver_list').empty().html(data);
        },
        error: function(xhr) {
            // Gestion des erreurs
            console.log(xhr.responseText);
        }
        });

        $(document).ready(function() {
        $('#search_driver').on('input', function(event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre normalement

            var formData = $(this).serialize(); // Récupère les données du formulaire
            var url = "{{ route('search_driver') }}";
            $.ajax({
            url: url,
            method: 'GET',
            data: formData,
            success: function(data) {
                // Manipulation des données reçues
                $('#driver_list').empty().html(data);
            },
            error: function(xhr) {
                // Gestion des erreurs
                console.log(xhr.responseText);
        }
        });
    });
    });
    
</script>