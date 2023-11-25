@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Plans</span>
        </div>
    </div>

    <form method="POST" action="{{route('store_plan')}}">
        @csrf

        <div class="settings-panel">
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
            <div class="">
                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0">Plan Name <span class="text-danger">*</span></p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
                <div class="px-4 py-2 row">
                    <input class="wrapper border-none background-white outline-none" name="name" placeholder="Enter plan name" value="{{old('name')}}"/>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>

                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0">Plan Price <span class="text-danger">*</span></p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
                <div class="px-4 py-2 row">
                    <input type="number" class="wrapper border-none background-white outline-none" name="price" placeholder="Enter Plan Price" value="{{old('price')}}" />
                    <div class="stroke-line wrapper pb-3"></div>
                </div>


                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0">Frequency <span class="text-danger">*</span></p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
                <div class="px-4 py-2 row">
                    <select class="wrapper border-none background-white outline-none p-2" name="frequency">
                        <option disabled>Select frequency</option>
                        <option value="week" {{ old('frequency') == 'week' ? 'selected' : '' }}>Week</option>
                        <option value="month" {{ old('frequency') == 'month' ? 'selected' : '' }}>Month</option>
                        <option value="year" {{ old('frequency') == 'year' ? 'selected' : '' }}>Year</option>
                        <option value="day" {{ old('frequency') == 'day' ? 'selected' : '' }}>Day</option>
                    </select>                    
                    <div class="stroke-line wrapper pb-3"></div>
                    
                </div>

                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0" >Number of users included <span class="text-danger">*</span></p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
                <div class="px-4 py-2 row">
                    <input type="number" class="wrapper border-none background-white outline-none" name="no_of_users_included" placeholder="Enter Number Of Users Included" value="{{old('no_of_users_included')}}"/>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>

                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0">Price per additional user</p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
                <div class="px-4 py-2 row">
                    <input class=" wrapper border-none background-white outline-none" name="price_per_additional_user" placeholder="Enter Price Per Additional User" value="{{old('price_per_additional_user')}}"/>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>

                <div class="row p-2 back-white">
                    <div class="col-md-12">
                        <textarea rows="10"  class="wrapper border-none background-white outline-none" spellcheck="true" name="description" placeholder="Type Description">{{old('description')}}</textarea>
                        <div class="stroke-line wrapper pb-3"></div>
                    </div>
                </div>

                <div class="px-4 py-2 pt-4 row">
                    <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0" style="letter-spacing: 0.7px">Accessible features</p>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>

                @foreach($permissions as $permission)
                    <div class="px-4 py-2 row">
                        <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="roles_checkbox" {{ in_array($permission->id, old('permission', [])) ? 'checked' : '' }} />
                        <span class="roles_label">{{$permission->name}}</span>        
                    </div>
                @endforeach

                <div class="px-4 py-2 row back-white">
                    <div class="col-md-12">
                        <input class="text-center p-4 wrapper selectable-button-selected" style="color:white;" id="disclaimer_save" name="save" type="submit" value="Save"/>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
