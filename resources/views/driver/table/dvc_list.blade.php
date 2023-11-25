@foreach ($dvcs as $item)
<div class="px-4 py-2 pt-4" id="user_data">
    <div class="row" id="row_">
        <div class="col-md-8">
            <h4>{{$item->vehicle_category->name}}</h4>
        </div>
        <div class="col-md-2">
            <button type="button" class="back-sky p-3 view_details color-white border-radius-30" 
            data-toggle="modal" data-target="#modal_dvc"
            data-id="{{$item->id}}"
            data-vehicle_category_id="{{$item->vehicle_category_id}}"
            data-name="{{$item->name}}"
            data-price_per_hour="{{$item->price_per_hour}}"
            data-price_per_mile="{{$item->price_per_mile}}"
            data-base_price="{{$item->base_price}}"
            data-included="{{$item->included}}"
            data-percentage="{{$item->percentage}}"
            data-payout_calculation="{{$item->payout_calculation}}"
            >
                Edit
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{route('delete_dvc',['id'=>$item->id])}}"><i class="fa fa-times p-2 color-red" data-id="" style="font-size:24px;color:red;"></i></a>
        </div>
    </div>
</div>
@endforeach  
