@foreach ($trips as $trip) 
    <div class="row pr-4 pl-4 pt-4 customer_block record_block" >
        <div class="col-md-12 back-white border-radius-10">
            <div class="row px-3 pt-3">
                <div class="col-md-12"><span class="font120"><b>{{$trip->customer->first_name.' '.$trip->customer->last_name}}</b></span>
                    <br> <span class="font120"><b>{{ $trip->trip_date.' '.$trip->start_time}}</b></span>
                </div>
            </div>
            <div class="row px-3 mt-3">
                <div class="col-md-12"><span class="font120"><b>Driver:</b> {{$trip->driver->first_name.' '.$trip->driver->last_name}}</span></div>
            </div>
            <div class="row px-3 mt-3">
                <div class="col-md-12"><span class="font120"><b>Vehicle</b>: {{$trip->vehicle->make.' '.$trip->vehicle->model}}</span></div>
            </div>
            <div class="row px-3 mt-3">
                <div class="col-md-12"><span class="font120"><b>From</b>: {{$trip->from_location}}</span></div>
            </div>
            <div class="row px-3 mt-3">
                <div class="col-md-12"><span class="font120"><b>To</b>: {{$trip->to_location}}</span></div>
            </div>
            <div class="row px-3 pb-2 pt-1 mt-3">
                <div class="col-md-12 py-2"><span class="font120"
                        style="line-height:100%; vertical-align:middle;"><b>Price</b>: {{'$'.$trip->price}}</span></div>

                    <div class="col-md-6">                                        
                        <a href="{{route('manage_booking',['id'=>$trip->id])}}">
                            <div class="text-center wrapper selectable-button-selected px-3 py-1 mt-3"
                                style="color:white;" id="trip_edit">Manage</div>
                        </a>
                    </div>
                <div class="col-md-6">
                    <a href="">
                        <div class="text-center wrapper selectable-button-selected px-3 py-1 mt-3"
                            style="color:white;" id="trip_edit">Edit</div>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endforeach