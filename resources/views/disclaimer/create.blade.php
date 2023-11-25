@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bold registerText">Disclaimer</h4>
        </div>
    </div>
    <form method="post" action="{{route('disclaimer.store')}}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white"
                            src="{{ asset('/images/fast-simple-logo.png') }}"
                            style="margin-top: -80px; width: 204px; height: auto;" /></span>
                </div>
            </div>
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Enter Disclaimer</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <textarea rows="10"
                    class="{{ $errors->has('disclaimer') ? 'is-invalid' : '' }} wrapper border-none background-white outline-none"
                    spellcheck="true" name="disclaimer" id="disclaimer"
                    placeholder="Enter Disclaimer">{{ isset($data->disclaimer) == true ? $data->disclaimer : old('disclaimer') }} </textarea>

                <div class="stroke-line wrapper pb-3"></div>
                @if ($errors->has('disclaimer'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('disclaimer') }}</strong>
                    </span>
                @enderror
            </div>

        <div class="px-4 py-2 row">
            <div class="col-md-12">
                <button
                    class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                    type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
@endsection
