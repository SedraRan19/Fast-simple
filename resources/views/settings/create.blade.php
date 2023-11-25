@extends('layouts.app')

@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">Settings</span>
        </div>
    </div>
    <div class="settings-panel">
        <div class="py-2 row">
            <div class="col-md-12">
                <span class="font-weight-bold">Email Settings</span>
                <div class="wrapper p-2"></div>
            </div>
        </div>
        <form method="post" action="{{route('updateOrCreate_setting')}}">
            @csrf
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
                <input
                    class="wrapper border-none back-white outline-none"
                    name="smtp_host" placeholder="Enter SMTP Host" id="smtp_host" value="{{$setting->smtp_host ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class=" wrapper border-none back-white outline-none"
                    name="smtp_username" placeholder="Enter SMTP Username" id="smtp_username" value="{{$setting->smtp_username ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

            <div class="px-4 py-2 row">
                <input type="password"
                    class="wrapper border-none back-white outline-none"
                    name="smtp_password" placeholder="Enter SMTP Password" id="smtp_password" value="{{$setting->smtp_password ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

            <div class="px-4 py-2 row">
                <input type="number"
                    class="wrapper border-none back-white outline-none"
                    name="smtp_port" placeholder="Enter SMTP Port" id="smtp_port" value="{{$setting->smtp_port ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class="rapper border-none back-white outline-none"
                    name="smtp_address" placeholder="Enter SMTP Email Address" id="smtp_address" value="{{$setting->smtp_address ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

           
            <div class="py-2 row mt-3">
                <div class="col-md-12">
                    <span class="font-weight-bold">Stripe keys</span>
                    <div class="wrapper p-2"></div>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none back-white outline-none"
                    name="stripe_public_key" placeholder="Enter Stripe Public Key" id="stripe_public_key" value="{{$setting->stripe_public_key ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>

            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none back-white outline-none"
                    name="stripe_secret_key" placeholder="Enter Stripe Secret Key" id="stripe_secret_key" value="{{$setting->stripe_secret_key ?? ''}}" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>


            {{-- <div class="py-2 row mt-3">
                <div class="col-md-12">
                    <span class="font-weight-bold">Timezone</span>
                    <div class="wrapper p-2"></div>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <select name="timezone" class="wrapper border-none back-white outline-none">
                        <option value="America/Chicago">America/Chicago</option>
                        <option value="Autre_Temps_Zone">Autre Temps Zone</option>
                    </select>
                </div>
            </div>
            

            <div class="py-2 row mt-3">
                <div class="col-md-12">
                    <span class="font-weight-bold">Cancellation Policy</span>
                    <div class="wrapper p-2"></div>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <textarea rows="10"
                        class="wrapper border-none background-white outline-none"
                        spellcheck="true" name="cancellation_policy" id="cancellation_policy" placeholder="Enter Cancellation Policy"> </textarea>
                    <div class="stroke-line wrapper pb-3"></div>
                </div>
            </div> --}}

            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <input class="text-center p-4 wrapper selectable-button-selected font120" style="color:white;"
                        name="save" type="submit" value="Save" />
                </div>
            </div>
        </form>
    </div>
@endsection
