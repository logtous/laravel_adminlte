@extends('layouts.app')

@section('title', __('system.user.role'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.user.role') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.user.role') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="{{ route('user.assignRole', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly="readonly">
              </div>
              <div class="form-group">
                <label for="inputEmail">{{ __('Email') }}</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly="readonly">
              </div>
              <div class="form-group">
                <label for="inputRole">{{ __('Role') }}</label>
                <div class="form-control" style="border: 0px">
                  @forelse($roles as $role)
                    <div class="form-check d-inline">
                      <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}" {{ $role->own ? 'checked' : ''  }}>
                      <label class="form-check-label">{{$role->name}}</label>
                    </div>
                  @empty
                  @endforelse
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-2">
          <input type="submit" value="{{ __('Submit') }}" class="btn btn-success">
          <a href="{{ route('user.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
@endsection
