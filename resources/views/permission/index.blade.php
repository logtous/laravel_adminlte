@extends('layouts.app')

@section('title', __('system.permission'))

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treegrid/0.2.0/css/jquery.treegrid.min.css">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.permission') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.permission') }}</li>
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
        @can('system.permission.create')
        <a class="btn btn-success" href="{{ route('permission.create') }}" role="button">{{ __('Add') }}</a>
        @endcan
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects" id="table"></table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection

@section('js')
  <script src="https://cdn.bootcss.com/bootstrap-table/1.12.0/extensions/treegrid/bootstrap-table-treegrid.js"></script>
  <script src="https://cdn.bootcss.com/jquery-treegrid/0.2.0/js/jquery.treegrid.min.js"></script>
  <script type="text/javascript">
    $(function() {
        $('#table').bootstrapTable({
            data: JSON.parse('{!! $permissions !!}'),
            idField: 'id',
            dataType: 'jsonp',
            columns: [
              { field: 'id',  title: '{{ __('Id') }}', sortable: true, align: 'center' },
              { field: 'display_name',  title: '{{ __('Name') }}' },
              { field: 'route', title: '{{ __('Route') }}' },
              { field: 'icon',  title: '{{ __('Icon') }}', formatter: 'iconFormatter' },
              { field: 'type',  title: '{{ __('Type') }}', formatter: 'typeFormatter' },
              { field: 'created_at', title: '{{ __('Created At') }}' },
              { field: 'updated_at', title: '{{ __('Updated At') }}' },
              { field: 'operate', title: '{{ __('Actions') }}', align: 'center', events : 'operateEvents', formatter: 'operateFormatter'},
            ],
            treeShowField: 'display_name',
            parentIdField: 'parent_id',
            // reset default loading message
            formatLoadingMessage: function() {
                    return "";
            },
            onResetView: function(data) {
                $('#table').treegrid({
                    initialState: 'collapsed',
                    // initialState: 'expanded',
                    treeColumn: 1,
                });
                $('#table').treegrid('getRootNodes').treegrid('expand');
            },
        });
    });

    function operateFormatter(value, row, index) {
        return [
            '<button type="button" class="view btn btn-primary btn-sm" style="margin-right:5px;"><i class="fas fa-folder" ></i>&nbsp;{{ __('View') }}</button>',
            '@can("system.permission.edit")<button type="button" class="edit btn btn-info btn-sm" style="margin-right:5px;"><i class="fas fa-pencil-alt" ></i>&nbsp;{{ __('Edit') }}</button>@endcan',
            '@can("system.permission.destroy")<button type="button" class="delete btn btn-danger btn-sm" style="margin-right:5px;" data-toggle="modal" data-target="#modal-sm" data-id="'+ row.id +'"><i class="fas fa-trash" ></i>&nbsp;{{ __('Delete') }}</button>',
            '<form action="/permission/'+ row.id +'" method="POST" id="'+ row.id +'">@method('DELETE')@csrf</form>@endcan'
        ].join('');

    }

    function iconFormatter(value, row, index) {
        return '<i class="nav-icon fas ' + value + '"></i>';
    }

    function typeFormatter(value, row, index) {
        if (value === 1) {
            return '<i class="nav-icon fas fa-list"></i>';
        } else {
            return '<i class="nav-icon fas fa-link"></i>';
        }
    }

    window.operateEvents = {
        'click .view': function (e, value, row, index) {
            window.location.href = "/permission/" + row.id;
        },
        'click .edit': function (e, value, row, index) {
            window.location.href = "/permission/" + row.id + '/edit';
        },
        // 'click .delete': function (e, value, row, index) {
        //     document.getElementById(row.id).submit();
        // },
    };
  </script>
@endsection
