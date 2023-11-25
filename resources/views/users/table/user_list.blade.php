@foreach ($users as $user)
<div class="row p-4 customer_block record_block">
    <div class="col-md-12 back-white border-radius-10">
        <div class="row px-3 py-2">
            <div class="col-md-12 py-2"><span style="line-height:100%" class="font120">
                    {{$user->first_name.' '.$user->last_name}}
                </span>
                    <a  href="{{route('delete_user',['id'=>$user->id])}}" class="float-right font200 color-red " title="Delete User?">&times;</a>
            </div>
        </div>
        <div class="row px-3 py-2">
            <div class="col-md-12 back-white py-2">
                <span><a href="tel:{{$user->phone}}"><i class="fa fa-phone-square font200 color-sky px-2"></i></a></span>
                <span><a href="sms:{{$user->phone}}"><i class="fa fa-comments font200 color-sky px-2"></i></a></span>
                <span><a href="mailto:{{$user->email}}"><i class="fa fa-envelope font200 color-sky px-2"></i></a></span>
            </div>
        </div>
        <div class="row px-3 py-2">
            <div class="col-md-8 py-2 color-red"><span
                    style="line-height:100%; vertical-align:middle;">{{$user->role->name}}</span></div>
            <div class="col-md-4 py-2">
                <a href="{{route('edit_user',['id'=>$user->id])}}">
                    <div class="text-center wrapper selectable-button-selected px-3 py-1"
                        style="color:white;" id="customer_edit">Edit</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach