@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
                <a href="{{ route('create_vehicle_categories') }}" class="back-sky color-white" style="z-index:10;"><i
                    class="fa fa-plus p-3 float-right back-sky border-radius-30" style="margin: 15px 20px 0px 0px;"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Vehicle Category</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 py-2">
            @foreach ($categories as $category)
                <div class="row p-4 customer_block record_block" 
                     data-param2="" data-param3="">
                    <div class="col-md-12 back-white border-radius-10">
                        <div class="row px-3 py-2">
                            <div class="col-md-12 py-2">
                                <span style="line-height:100%" class="font120">{{$category->name}}</span>
                                    <a  href="{{route('delete_vehicle_category',['id'=>$category->id])}}" onclick="return confirm('Are you sure you want to delete this vehicle?')" class="float-right font200 color-red" title="Delete Vehicle Category?">&times;</a>
                            </div>
                        </div>
                        <div class="row px-3 py-2">
                            <div class="col-md-3 back-white py-2">
                                <span>{{'$'.$category->price_per_hour.'/h'}}</span>
                            </div>
                            <div class="col-md-3 back-white py-2">
                                <span>{{'$'.$category->price_per_mile.'/m'}}</span>
                            </div>
                            <div class="col-md-2 back-white py-2">
                            </div>

                            <div class="col-md-4 py-2 float-right">
                                <a href="{{route('edit_vehicle_category',['id'=>$category->id])}}">
                                    <div class="text-center wrapper selectable-button-selected px-3 py-1"
                                        style="color:white;" id="customer_edit">Edit</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
