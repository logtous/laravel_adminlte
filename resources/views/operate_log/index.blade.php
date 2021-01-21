@extends('layouts.app')

@section('title', __('system.operate_log'))

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.operate_log') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.operate_log') }}</li>
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
                        {{ __('Uri') }}
                    </th>
                    {{-- <th style="width: 10%">
                        {{ __('Parameter') }}
                    </th> --}}
                    <th style="width: 10%">
                        {{ __('method') }}
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
                @foreach($operate_logs as $operate_log)
                <tr>
                    <td>
                        {{ $operate_log->id }}
                    </td>
                    <td>
                        {{ $operate_log->user_name }}
                    </td>
                    <td>
                        {{ $operate_log->uri }}
                    </td>
                    {{-- <td>
                        {{ $operate_log->parameter }}
                    </td> --}}
                    <td>
                        {{ $operate_log->method }}
                    </td>
                    <td>
                        {{ $operate_log->created_at }}
                    </td>
                    <td class="project-actions text-center">
                        @can('system.operate_log.destroy')
                        <button type="button" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm" data-id="{{ $operate_log->id }}">
                          <i class="fas fa-trash">
                          </i>
                          {{ __('Delete') }}
                        </button>
                        <form action="{{ route('operate_log.destroy', $operate_log->id) }}" method="POST">
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
        {{ $operate_logs->links() }}
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection
