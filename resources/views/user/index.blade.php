@extends('layouts.app')

@section('title', __('system.user'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.user') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.user') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        @can('system.user.create')
        <a class="btn btn-success" href="{{ route('user.create') }}" role="button">{{ __('Add') }}</a>
        @endcan
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 5%">
                        {{ __('Id') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('Name') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('Email') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('Created At') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('Updated At') }}
                    </th>
                    <th style="width: 20%" class="text-center">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                    <td>
                        {{ $user->updated_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('user.show', $user->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            {{ __('View') }}
                        </a>
                        @can('system.user.edit')
                        <a class="btn btn-info btn-sm" href="{{ route('user.edit', $user->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            {{ __('Edit') }}
                        </a>
                        @endcan
                        @can('system.user.role')
                        <a class="btn btn-success btn-sm" href="{{ route('user.role', $user->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            {{ __('Assign ', ['Name' => __('Role') ]) }}
                        </a>
                        @endcan
                        @can('system.user.permission')
                        <a class="btn btn-secondary btn-sm" href="{{ route('user.permission', $user->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            {{ __('Assign ', ['Name' => __('Permission') ]) }}
                        </a>
                        @endcan
                        @can('system.user.destroy')
                        <button type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm" data-id="{{ $user->id }}">
                          <i class="fas fa-trash">
                          </i>
                          {{ __('Delete') }}
                        </button>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" id="{{ $user->id }}">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endcan
                      </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        {{ $users->links() }}
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
