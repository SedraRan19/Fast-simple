@extends('layouts.app')

@section('content')
<div class="row py-4">
  <div class="col-md-12">
    <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
        <a href="{{route('create_customers')}}" class="back-sky color-white" style="z-index:10;">
          <i class="fa fa-plus p-3 float-right back-sky border-radius-30" style="margin: 15px 20px 0px 0px;"></i>
        </a>
    <span class="text-center font-weight-bold text-dark maintitlecustomer">Customers</span>
  </div>
</div>

<div class="row py-2">
  <div class="col-md-12">
  <form action="" >
    @csrf
      <input class="wrapper border-radius-10 p-3 background-white outline-none" name="search" type="search" id="search_customer" placeholder="Search" />
      {{-- <input type="submit"  /> --}}
      {{-- oninput="searchForRecord(this);" --}}
    </form>
  </div>
</div>

<div class="row">
  <div class="col-md-12 py-2" id="customer_list">
      {{-- CUSTOMER LIST --}}
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
    $.ajax({
        url: "{{ route('customer_list') }}",
        method: 'GET',
        success: function(data) {
            // Manipulation des données reçues
            $('#customer_list').empty().html(data);
        },
        error: function(xhr) {
            // Gestion des erreurs
            console.log(xhr.responseText);
        }
        });

        $(document).ready(function() {
    $('#search_customer').on('input', function(event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre normalement

        var formData = $(this).serialize(); // Récupère les données du formulaire
        var url = "{{ route('search_customer') }}";
        $.ajax({
        url: url,
        method: 'GET',
        data: formData,
        success: function(data) {
            // Manipulation des données reçues
            $('#customer_list').empty().html(data);
        },
        error: function(xhr) {
            // Gestion des erreurs
            console.log(xhr.responseText);
      }
    });
  });
});
    
</script>
