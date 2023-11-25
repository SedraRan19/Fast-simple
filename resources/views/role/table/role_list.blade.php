@foreach ($roles as $role)
<div class="row p-4 role_block record_block">
    <div class="col-md-12 back-white border-radius-10">
        <div class="row px-3 py-2">
            <div class="col-md-12 py-2">
                <span style="line-height:100%" class="font160">{{$role->name}}</span>
                        <a href="{{route('delete_role',['id'=>$role->id])}}" class="float-right font200 color-red " title="Delete Role?">&times;</a>
                    <ul class="list-group">
                        @php
                         $permissions = App\Models\Permission_role::where('role_id',$role->id)->get();
                        @endphp
                        @foreach ($permissions as $permission)
                            <li class="list-group-item">{{'-'.$permission->permission->name}}</li>
                        @endforeach
                    </ul>
                <div class="col-md-4 py-2 float-right">
                        <a href="{{route('edit_role',['id'=>$role->id])}}">
                            <div class="text-center wrapper selectable-button-selected px-3 py-1"
                                style="color:white;" id="customer_edit">Edit</div>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach