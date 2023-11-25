@extends('layouts.app')
@section('content')
<div class="row py-4">
    <div class="col-md-12">
        <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <a href="{{route('create_plan')}}" class="back-sky color-white" style="z-index:10;"><i class="fa fa-plus p-3 float-right back-sky border-radius-30" style="margin: 15px 20px 0px 0px;"></i></a>
        <span class="text-center font-weight-bold text-dark maintitlecustomer">Your Plans</span>
    </div>
</div>

<div class="color-green text-center font100 font-weight-bold">
    <p id="status"></p>
</div>

<div class="row">

    <div class="col-md-12 py-2">
        @foreach ($plans as $plan)
        <div class="row p-4 customer_block record_block" >
            <div class="col-md-12 back-white border-radius-10">
                <div class="row px-3 py-2">
                <div class="col-md-12">
                    <span style="line-height:100%" class="font120 font-weight-bold">
                            {{$plan->name}}
                    </span>
                     <a href="{{route('delete_plan',['id'=>$plan->id])}}" class="float-right font200 color-red " title="Delete Plan?">&times;</a>
                </div>
            </div>
            <div class="row px-3">
                <div class="col-md-8"><span style="line-height:100%;">{{'$'.$plan->price.'/'.$plan->frequency}}</span>
                    <br>
                    <label class="switch mt-3">
                        <input class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" selected >
                        <span class="slider round"></span>
                    </label>
                </div>
                    <div class="col-md-4 pt-5">
                        <a href="{{route('edit_plan',['id'=>$plan->id])}}">
                            <div class="text-center wrapper selectable-button-selected px-3 py-1" style="color:white;" id="customer_edit">Edit</div>
                        </a>
                    </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection

<script>
    var update_status = "{{url('/update-plan-status')}}";
</script>
