@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitlecustomer">Your Plans</span>
        </div>
    </div>
    <div class="color-green text-center font100 font-weight-bold">
        <p id="status"></p>
    </div>

    <div class="row">
        <div class="col-md-12 py-2">
            @foreach ($plans as $plan)
                <div class="row p-4 customer_block">
                    <div class="col-md-12 back-white border-radius-10" style="border: 2px solid #114b93" >
                        <div class="row px-3 py-2">
                            {{--<div class="col-md-12 py-2"><span style="line-height:100%" class="font120 font-weight-bold">{{$plan->name}}</span><span style="line-height:100%" class="font120 ml-5 font-weight-bold">${{$plan->cost}}/{{$plan->stripe_plan}}</span><span onclick="deletePlan({{$plan->id}})" class="float-right font200 color-red">&times;</span></div>--}}
                            <div class="col-md-12 py-2"><span style="line-height:100%" class="font120 font-weight-bold">{{$plan->name}}</span></div>
                        </div>
                        <div class="row px-3 py-2">
                            <div class="col-md-8 py-2"><span style="line-height:100%; vertical-align:middle;">{{'$'.$plan->price.'/'.$plan->frequency}}</span></div>
                        </div>
                        <ul class="list-group">
                            @php
                             $permissions = App\Models\Plan_permission::where('plan_id',$plan->id)->get();
                            @endphp
                            @foreach ($permissions as $permission)
                                <li class="list-group-item">{{'-'.$permission->permission->name}}</li>
                            @endforeach
                        </ul>
                        <div class="row px-3 py-2">
                            <a href="{{route('pay_plan',['id'=>$plan->id])}}" class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold" style="color:white;">Select Plan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
