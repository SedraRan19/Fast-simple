
<div class="modal fade" id="modal_dvc" role="dialog" style="background-color:rgb(0 0 0 / 0%) !important;">
<div class="modal-dialog" role="document">
    <div class="modal-content model-content-custom">
        <div class="modal-header">
            <h5 style="margin-top:8px;" class="modal-title" id="exampleModalLabel">Driver - Vehicle Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body " style="background-color:rgb(0 0 0 / 0%) !important;">
            {{-- <div id="error-display"><span class="error">Please fill all mandotory fileds</span></div> --}}
                <div class="">
                    <form method="post" action="{{route('edit_dvc')}}">
                        @csrf
                        <input
                            class="wrapper border-none background-white outline-none"
                            type="hidden" name="dvc_id" id="id"
                            value="" />
                    <div class="px-4 py-2 pt-4 row model-head">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Vehicle Category *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <select name="vehicle_category_id" id="vehicle_category_id" class="form-control" name="vehicle_category_id">
                            @foreach($categories as $item)    
                            <option value="{{$item->id}}" {{ old('vehicle_category_id', $item->id) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="stroke-line wrapper pb-3"></div>

                    </div>

                     <div class="px-4 py-2 pt-4 row model-head">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Price Per Hour ($) *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <input id="price_per_hour" 
                            class="wrapper border-none background-white outline-none"
                            name="price_per_hour" placeholder="Type Price Per Hour"
                            value="{{old('price_per_hour')}}" />
                        <div class="stroke-line wrapper pb-3"></div>

                    </div>

                     <div class="px-4 py-2 pt-4 row model-head">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Price Per Mile ($) *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <input id="price_per_mile" 
                            class="wrapper border-none background-white outline-none"
                            name="price_per_mile" placeholder="Type Price Per Mile"
                            value="{{old('price_per_mile')}}" />
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>

                     <div class="px-4 py-2 pt-4 row">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Base Price ($) *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <input id="base_price"
                            class=" wrapper border-none background-white outline-none"
                            name="base_price" placeholder="Base Price"
                            value="{{old('base_price')}}" />
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>

                     <div class="px-4 py-2 pt-4 row">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Miles Included *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <input id="included" 
                            class="wrapper border-none background-white outline-none"
                            name="included" placeholder="Miles Included"
                            value="{{old('included')}}" />
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>

                    <div class="px-4 py-2 pt-4 row">
                        <p class="wrapper border-none outline-none font-weight-bold color-dark pl-3 mb-0"
                            style="letter-spacing: 0.7px">Percentage *</p>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                    <div class="px-4 py-2 row">
                        <input id="percentage" type="number" 
                            class="wrapper border-none background-white outline-none"
                            name="percentage" placeholder="Percentage"
                            value="{{old('percentage')}}" />
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>

                    <div class="row">
                        <label class="col-md-12 control-label" for="checkboxes">Default payout calculation</label>
                    </div>
                    <div class="row">
                        <div class="form-group" style="display:inline-flex;width:-webkit-fill-available;">
                            <label class="col-md-6 checkbox-inline" for="hourly_miles">
                                <input type="checkbox" name="payout_calculation" class="hourly_miles" id="hourly_miles" value="0">
                                Hourly + Milage
                            </label>
                            <label class="col-md-6 checkbox-inline" for="default_payout_percentage">
                                <input type="checkbox" name="payout_calculation" class="default_payout_percentage" id="default_payout_percentage" value="1">
                                Percentage
                            </label>
                        </div>
                    </div>
                </div>        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
</div>
</div>
