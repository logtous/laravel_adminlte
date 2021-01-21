@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{ __('You forgot your password? Here you can easily retrieve a new password.') }}</p>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <form action="{{ route('password.email') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      @if (Route::has('login'))
        <p class="mt-3 mb-1 text-center">
          <a href="{{ route('login') }}">{{ __('Login') }}</a>
        </p>
      @endif
      @if (Route::has('register'))
        <p class="mb-0 text-center">
          <a href="{{ route('register') }}" class="text-center">{{ __('Register') }}</a>
        </p>
      @endif
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
