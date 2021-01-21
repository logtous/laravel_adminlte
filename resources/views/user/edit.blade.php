@extends('layouts.app')

@section('title', __('system.user.edit'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.user.edit') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.user.edit') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="{{ route('user.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body">
              @include('user._form', ['action' => 'edit'])
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
