<div class="form-group">
  <label for="inputName">{{ __('Name') }}</label>
  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $user->name ?? old('name') }}" placeholder="{{ __('Please enter ', ['name' => __('Name') ]) }}" @if($action == 'show') readonly="readonly" @endif autocomplete="username">
  @if($errors->has('name'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('name') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputEmail">{{ __('Email') }}</label>
  <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $user->email ?? old('email') }}" placeholder="{{ __('Please enter ', ['name' => __('Email')]) }}" @if($action == 'show') readonly="readonly" @endif autocomplete="email">
  @if($errors->has('email'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('email') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputPassword">{{ __('Password') }}</label>
  <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ $user->password ?? old('password') }}" placeholder="{{ __('Please enter ', ['name' => __('Password') ]) }}" @if($action == 'show') readonly="readonly" @endif autocomplete="new-password">
  @if($errors->has('password'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('password') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputPasswordConfirmation">{{ __('Confirm Password') }}</label>
  <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" value="{{ $user->password ?? old('password') }}" placeholder="{{ __('Please enter ', ['name' => __('Confirm Password')]) }}" @if($action == 'show') readonly="readonly" @endif autocomplete="new-password">
  @if($errors->has('password_confirmation'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('password_confirmation') }}</strong>
    </div>
  @endif
</div>
