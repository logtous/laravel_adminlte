@section('css')
  <style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 18px;
    }
  </style>
@endsection
<div class="form-group">
  <label for="inputName">{{ __('Name') }}</label>
  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $permission->name ?? old('name') }}" placeholder="{{ __('Please enter ', ['name' => __('Name')]) }}" @if($action == 'show') readonly="readonly" @endif>
  @if($errors->has('name'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('name') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputRoute">{{ __('Route') }}</label>
  <input type="text" name="route" class="form-control {{ $errors->has('route') ? 'is-invalid' : '' }}" value="{{ $permission->route ?? old('route') }}" placeholder="{{ __('Please enter ', ['name' => __('Route')]) }}" @if($action == 'show') readonly="readonly" @endif>
  @if($errors->has('route'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('route') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputIcon">{{ __('Icon') }}</label>
  <input type="text" name="icon" class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" value="{{ $permission->icon ?? old('icon') }}" placeholder="{{ __('Please enter ', ['name' => __('Icon')]) }}" @if($action == 'show') readonly="readonly" @endif>
  @if($errors->has('icon'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('icon') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputParentId">{{ __('Parent Permission') }}</label>
  <select name="parent_id" id="parent_id" class="form-control {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" @if($action == 'show') disabled="disabled" @endif>
      <option value="0">{{ __('Default') }}</option>
      @forelse($permissions as $p1)
        <option value="{{$p1->id}}" {{ isset($permission->id) && $p1->id == $permission->parent_id ? 'selected' : '' }} >@lang($p1->name)</option>
        @if($p1->childs->isNotEmpty())
          @foreach($p1->childs as $p2)
            <option value="{{$p2->id}}" {{ isset($permission->id) && $p2->id == $permission->parent_id ? 'selected' : '' }} >&nbsp;&nbsp;&nbsp;┗━━@lang($p2->name)</option>
            @if($p2->childs->isNotEmpty())
              @foreach($p2->childs as $p3)
                  <option value="{{$p3->id}}" {{ isset($permission->id) && $p3->id == $permission->parent_id ? 'selected' : '' }} >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┗━━@lang($p3->name)</option>
              @endforeach
            @endif
          @endforeach
        @endif
        @empty
      @endforelse
  </select>
  @if($errors->has('parent_id'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('parent_id') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputSort">{{ __('Sort') }}</label>
  <input type="text" name="sort" class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" value="{{ $permission->sort ?? old('sort') }}" placeholder="{{ __('Please enter ', ['name' => __('Sort')]) }}" @if($action == 'show') readonly="readonly" @endif>
  @if($errors->has('sort'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('sort') }}</strong>
    </div>
  @endif
</div>
<div class="form-group">
  <label for="inputType">{{ __('Type') }}</label>
  <select name="type" id="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" @if($action == 'show') disabled="disabled" @endif>
      <option>{{ __('Please select ...') }}</option>
      @forelse($type_list as $key => $val)
        <option value="{{ $key }}" {{ isset($permission->id) && $key == $permission->type ? 'selected' : '' }} >{{$val}}</option>
        @empty
      @endforelse
  </select>
  @if($errors->has('type'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('type') }}</strong>
    </div>
  @endif
</div>

@section('js')
  <script type="text/javascript">
    $(function () {
      $("#parent_id").select2();
    });
  </script>
@endsection
