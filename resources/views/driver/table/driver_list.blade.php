@foreach ($drivers as $driver)
    <div class="row p-4 customer_block record_block" >
        <div class="col-md-12 back-white border-radius-10">
            <div class="row px-3 py-2">
                <div class="col-md-12 py-2"><span style="line-height:100%" class="font120">
                        {{$driver->first_name.' '.$driver->last_name}}
                    </span>
                    <a href="{{route('delete_driver',['id'=>$driver->id])}}" class="float-right font200 color-red" title="Delete Driver?">&times;</a>
                </div>
            </div>

            <div class="row px-3 py-2">
                <div class="col-md-12 back-white py-2">
                    <span><a href="tel:{{ $driver->phone }}"><i class="fa fa-phone-square font200 color-sky px-2"></i></a></span>
                    <span><a href="sms:{{ $driver->phone }}"><i class="fa fa-comments font200 color-sky px-2"></i></a></span>
                    <span><a href="mailto:{{ $driver->email }}"><i class="fa fa-envelope font200 color-sky px-2"></i></a></span>
                </div>
            </div>
            @php
            $pay = 0;
            $umpaidDrivers = \App\Models\Driver_payout::where('driver_id',$driver->id)->get();   
            for ($i=0; $i <count($umpaidDrivers) ; $i++) { 
                $pay += $umpaidDrivers[$i]->amount;
            }
            @endphp
            <div class="row px-3 py-2">
                <div class="col-md-12 back-white py-2">
                    <span>Pending Payout : <b>{{'$'.$pay}}</b></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6 py-2 pull-right">
                    <a href="{{route('edit_driver',['id'=>$driver->id])}}" >
                        <div class="text-center wrapper selectable-button-selected px-3 py-1"
                            style="color:white;" id="customer_edit">Edit</div>
                    </a>
                </div>
                <div class="col-md-6 py-2 pull-right">

                    <a href="{{route('detail_driver',['id'=>$driver->id])}}" >
                        <div class="text-center wrapper selectable-button-selected px-3 py-1"
                            style="color:white;" id="customer_edit">detail</div>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
@endforeach