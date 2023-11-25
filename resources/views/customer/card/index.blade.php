@extends('layouts.app')

@section('content')
<div class="row py-4">
    <div class="col-md-12">
      <a href="{{route('customers')}}"><i class="fa fa-arrow-left p-4"></i></a>
          <a href="{{route('create_card',['id'=>$id])}}" class="back-sky color-white" style="z-index:10;">
            <i class="fa fa-plus p-3 float-right back-sky border-radius-30" style="margin: 15px 20px 0px 0px;"></i>
          </a>
      <span class="text-center font-weight-bold text-dark maintitlecustomer">Cards</span>
    </div>
  </div>
<div class="row py-2">
    <div class="col-md-12 p-0 pb-4">
        @foreach ($cards as $card)
        <div class="row pr-4 pl-4 mt-4 customer_block" id="card">
            <div class="col-md-12 back-white border-radius-10">
            <a href="{{route('delete_card',['id'=>$card->id])}}"><span class="float-right font200 color-red">&times;</span></a>
                <div class="row px-3 pt-3">
                    <div class="col-md-12">
                        <span class="font160">{{$card->card_holder_name.' '.$card->expiration_date}}</span>
                        {{-- <span style="margin-left:5px;color:#114b93;padding:5px;" >VISA</span> --}}
                    </div>
                </div>

                <div class="row px-3 mt-3 pb-3">
                    <div class="col-md-12"><span class="font120">Number : {{$card->card_number}}</span></div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

