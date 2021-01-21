@extends('layouts.app')

@section('title', __('system.role'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.role') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.role') }}</li>
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
        @can('system.role.create')
        <a class="btn btn-success" href="{{ route('role.create') }}" role="button">{{ __('Add') }}</a>
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
                @foreach($roles as $role)
                <tr>
                    <td>
                        {{ $role->id }}
                    </td>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ $role->created_at }}
                    </td>
                    <td>
                        {{ $role->updated_at }}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('role.show', $role->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            {{ __('View') }}
                        </a>
                        @can('system.role.edit')
                        <a class="btn btn-info btn-sm" href="{{ route('role.edit', $role->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            {{ __('Edit') }}
                        </a>
                        @endcan
                        @can('system.role.permission')
                        <a class="btn btn-success btn-sm" href="{{ route('role.permission', $role->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            {{ __('Assign ', ['Name' => __('Permission')]) }}
                        </a>
                        @endcan
                        @can('system.role.destroy')
                        <button type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm" data-id="{{ $role->id }}">
                          <i class="fas fa-trash">
                          </i>
                          {{ __('Delete') }}
                        </button>
                        <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        {{ $roles->links() }}
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
