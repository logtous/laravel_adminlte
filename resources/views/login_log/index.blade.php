@extends('layouts.app')

@section('title', __('system.login_log'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.login_log') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.login_log') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
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
                        {{ __('Ip') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('method') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('user_agent') }}
                    </th>
                    <th style="width: 10%">
                        {{ __('Created At') }}
                    </th>
                    <th style="width: 20%" class="text-center">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($login_logs as $login_log)
                <tr>
                    <td>
                        {{ $login_log->id }}
                    </td>
                    <td>
                        {{ $login_log->user_name }}
                    </td>
                    <td>
                        {{ $login_log->ip }}
                    </td>
                    <td>
                        {{ $login_log->method }}
                    </td>
                    <td>
                        {{ $login_log->user_agent }}
                    </td>
                    <td>
                        {{ $login_log->created_at }}
                    </td>
                    <td class="project-actions text-center">
                        @can('system.login_log.destroy')
                        <button type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm" data-id="{{ $login_log->id }}">
                          <i class="fas fa-trash">
                          </i>
                          {{ __('Delete') }}
                        </button>
                        <form action="{{ route('login_log.destroy', $login_log->id) }}" method="POST">
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
        {{ $login_logs->links() }}
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
