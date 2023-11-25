@extends('layouts.guest')

@section('content')
<div id="mydiv">
    <div class="background-white-50 h3 mt-0 border-bottom-0 mb-0">
        <div class="p-4 pt-5">
            <div class="row">
                <h1 class="text-center wrapper font-weight-bold text-dark">Sign in</h1>
            </div>
            <div class="row">
                <img class="wrapper p-logo" src="{{asset('/images/fast-simple-logo.png')}}" />
            </div>
            <form method="POST" action="#">
                @csrf
                
                <!-- Password -->
                <div>
                    <x-label for="password" :value="__('Password')" />
                
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>
                
                <div class="flex justify-end mt-4">
                    <x-button>
                        {{ __('Confirm') }}
                    </x-button>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection