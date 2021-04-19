@extends('layouts.app')

@section('content')
<div class="dt h-full w-full">
    <div class="dtc va-m">
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
                    @include('components.messages')
                    <form method="POST" action="{{ route('update-profile') }}">
                        <fieldset>
                        @csrf
                        @method('patch')

                            <div class="form-group row @error('password') has-error @enderror">
                                <label for="name" class="col-xs-12 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-xs-12">
                                    {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> --}}
                                    <input 
                                        id="name" 
                                        type="text" 
                                        class="form-control" 
                                        name="name" 
                                        value="{{ old('name') ? old('name') : $user->name }}">

                                    @error('nae')
                                        <span class="invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-mv-blue btn-mv">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </fieldset>

                    </form>
                </div>
                <div class="col-xs-12 text-center">
                    <form method="post" action="{{ route('delete-profile', ['user' => $user->id]) }}" class="d-inline-block" >
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" name="delete_action">
                            <span class="fas fa-times-circle"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
