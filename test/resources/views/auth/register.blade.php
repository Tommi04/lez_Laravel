@extends('layouts.app')
{{-- estendi qualcosa che ha bootstrap, non funziona niente se no --}}

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="dt h-full w-full">
    <div class="dtc va-m">
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
                    <form method="POST" action="{{ route('register') }}">
                        <fieldset>
                            <legend>
                                Register to Musa Vision
                            </legend>
                        @csrf
                        </fieldset>

                            <div class="form-group row @error('name') has-error @enderror">
                                <label for="name" class="col-xs-12 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-xs-12">
                                    {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                    <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}">

                                    @error('name')
                                        <span class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('email') has-error @enderror">
                                <label for="email" class="col-xs-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-xs-12">
                                    {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> --}}
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('password') has-error @enderror">
                                <label for="password" class="col-xs-12 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-xs-12">
                                    {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> --}}
                                    <input id="password" type="password" class="form-control" name="password" >

                                    @error('password')
                                        <span class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-xs-12 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-xs-12">
                                    {{-- <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> --}}
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-mv-blue btn-mv">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
