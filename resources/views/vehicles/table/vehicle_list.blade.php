@foreach ($vehicles as $vehicle)
    <div class="row p-4 vehicle_block record_block" >
        <div class="col-md-12 back-white border-radius-10">
            <div class="row px-3 pt-3">
                <div class="col-md-12">
                    <span style="line-height:150%" class="font120">{{$vehicle->make}}</span>
                    <a href="{{route('delete_vehicle',['id'=>$vehicle->id])}}" class="float-right font200 color-red " onclick="return confirm('Are you sure you want to delete this vehicle?')" title="Delete Role?">&times;</a>
                </div>
            </div>
            <div class="row px-3">
                <div class="col-md-12">
                    <span style="line-height:100%" class="font80">{{$vehicle->model}}</span>
                </div>
            </div>
            <div class="row px-3">
                <div class="col-md-12 py-2">
                    <span style="line-height:100%"class="font80">{{$vehicle->license_plate}}</span>
                </div>
            </div>
            <div class="row px-3 pb-2">
                <div class="col-md-4">
                    <span style="line-height:150%; vertical-align:middle;"></span>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <a href="{{route('edit_vehicle',['id'=>$vehicle->id])}}">
                        <div class="text-center wrapper selectable-button-selected px-3 py-1" style="color:white;" id="customer_edit">Edit</div>
                    </a>
                </div>
            </div>
        </div>
    </div>        
@endforeach