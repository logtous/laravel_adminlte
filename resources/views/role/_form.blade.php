<div class="form-group">
  <label for="inputName">{{ __('Name') }}</label>
  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $role->name ?? old('name') }}" placeholder="{{ __('Please enter ', ['name' => __('Name')]) }}" @if($action == 'show') readonly="readonly" @endif>
  @if($errors->has('name'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('name') }}</strong>
    </div>
  @endif
</div>
