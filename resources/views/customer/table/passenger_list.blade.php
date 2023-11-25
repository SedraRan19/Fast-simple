@foreach ($customers as $customer)
  <div class="row p-4 customer_block record_block" id="customer_" >
    <div class="col-md-12 back-white border-radius-10">
      <div class="row px-3 py-2">
        <div class="col-md-12 py-2">
            <span style="line-height:100%" class="font120">{{$customer->first_name.' '.$customer->last_name}}</span>
            <a href="{{ route('delete_customer',['id'=>$customer->id]) }}" onclick="return confirm('Are you sure you want to delete this customer?')" class="float-right font200 color-red" title="Delete Customer?">&times;</a>
          </div>
      </div>
      <div class="row px-3 py-2">
        <div class="col-md-12 back-white py-2">
          <span><a href="tel:{{ $customer->phone }}"><i class="fa fa-phone-square font200 color-sky px-2"></i></a></span>
          <span><a href="sms:{{ $customer->phone }}"><i class="fa fa-comments font200 color-sky px-2"></i></a></span>
          <span><a href="mailto:{{ $customer->email }}"><i class="fa fa-envelope font200 color-sky px-2"></i></a></span>
        </div>
      </div>
      <div class="row px-3 py-2">
        <div class="col-md-8 py-2"><span style="line-height:100%; vertical-align:middle;">{{$customer->home_address}}</span></div>
        <div class="col-md-1">
          <a href="{{route('cards',['id'=>$customer->id])}}">
              <div style="color:white;" id="customer_edit"><i class="fa fa-credit-card color-sky pr-3 font140 py-1 minwidth50"></i></div>
          </a>
        </div>
        <div class="col-md-3">
              <a href="{{route('edit_customer',['id'=>$customer->id])}}">
                  <div class="text-center wrapper selectable-button-selected px-3 py-1"
                      style="color:white;" id="customer_edit">Edit</div>
              </a>
        </div>
      </div>
    </div>
  </div>
  @endforeach