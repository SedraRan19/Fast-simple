@extends('layouts.app')

@section('content')
<div class="row py-4">
    <div class="col-md-12">
        <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
        <span class="text-center font-weight-bold text-dark maintitle">Create Role</span>
    </div>
</div>
<form method="post" action="{{route('store_role')}}">
    @csrf
    <div class="settings-panel" style="margin: 65px 10px !important;">
        @if(session()->has("success"))
        <div class="alert alert-success" >
            {{session()->get('success')}}
        </div>
        @endif
        @if(session()->has("error"))
                <div class="alert alert-danger" >
                    {{session()->get('error')}}
                </div>
        @endif
        <div class="px-4 py-2 row">
            <input class="wrapper border-none background-white outline-none" name="name" placeholder="Enter Role Name" value=""/>
            <div class="stroke-line wrapper pb-3"></div>
        </div>
        <div class="px-4 py-2 row">

                @foreach($permissions as $permission)
                <div class="px-4 py-2 col-md-12">
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="roles_checkbox"  /> <span class="roles_label">{{$permission->name}}</span>
                    </label>
                </div>
                @endforeach
        </div>

        <div class="px-4 py-2 row">
            <div class="col-md-12">
                <button class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
@endsection
