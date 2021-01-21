<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel_adminlte') }} | @yield('title')</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- flag-icon-css -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/flag-icon-css/css/flag-icon.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.css') }}">
  <!-- Bootstrap Table -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap-table.min.css') }}">
  <!-- Additional css -->
  @yield('css')
  <style type="text/css">
    .ui-autocomplete {
      z-index:9999 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="search" size="50">
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-language" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="{{ url('setlocale/zh-CN') }}" class="dropdown-item">
            <i class="flag-icon flag-icon-cn mr-2"></i> 中文
          </a>
          <a href="{{ url('setlocale/en') }}" class="dropdown-item">
            <i class="flag-icon flag-icon-us mr-2"></i> English
          </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel_adminlte') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @foreach($menus as $menu)
            @can($menu->name)
              <li class="nav-item has-treeview">
                @if($menu->route)
                <a href="{{ route($menu->route) }}" class="nav-link">
                  <i class="nav-icon fas {{$menu->icon}}"></i>
                  <p>@lang($menu->name)</p>
                </a>
                @else
                <a href="#" class="nav-link">
                  <i class="nav-icon fas {{$menu->icon}}"></i>
                  <p>
                    @lang($menu->name)
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @endif
                @if($menu->childs->isNotEmpty())
                  @foreach($menu->childs as $subMenu)
                    @can($subMenu->name)
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route($subMenu->route) }}" class="nav-link">
                          <i class="nav-icon fas {{$subMenu->icon}}"></i>
                          <p>@lang($subMenu->name)</p>
                        </a>
                      </li>
                    </ul>
                    @endcan
                  @endforeach
                @endif
              </li>
            @endcan
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
    <!-- Delete confirm dialog -->
    <div class="modal fade">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ __('Notice') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>{{ __('Confirm delete?') }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="button" id="delete" class="btn btn-danger" data-dismiss="modal">{{ __('Delete') }}</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
     <!-- /.modal-dialog -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019-{{ date('Y') }} <a href="{{ config('app.url', 'http://laravel_adminlte.test') }}">{{ config('app.name', 'Laravel_adminlte') }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {{ config('app.version', '1.0') }}
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.min.js') }}"></script>
<!-- Bootstrap Table -->
<script src="{{ asset('js/bootstrap-table.min.js') }}"></script>
<!-- Additional js -->
@yield('js')
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000
    });

    @if (session('status'))
      Toast.fire({
        icon: 'success',
        title: '{{ session('status') }}'
      });
    @endif

    @if (session('error'))
      Toast.fire({
        icon: 'error',
        title: '{{ session('error') }}'
      });
    @endif


    // delete confirm dialog
    $('.delete').click(function() {
      var id = $(this).data('id');

      $('.modal').modal('show');

      $("#delete").click(function() {
        document.getElementById(id).submit();
      });

      $("#cancel").click(function() {
        $('.modal').modal('hide');
      });
    });


    // menu active
    const url = window.location;

    $('ul.nav-sidebar a').filter(function() {
      return this.href == url || url.href.includes(this.href);
    }).parent().addClass('active');

    $('ul.nav-treeview a').filter(function() {
      return this.href == url || url.href.includes(this.href);
    }).parentsUntil(".sidebar-menu > .nav-treeview").addClass('menu-open');

    $('ul.nav-treeview a').filter(function() {
      return this.href == url || url.href.includes(this.href);
    }).addClass('active');

    $('li.has-treeview a').filter(function() {
      return this.href == url || url.href.includes(this.href);
    }).addClass('active');

    $('ul.nav-treeview a').filter(function() {
      return this.href == url || url.href.includes(this.href);
    }).parentsUntil(".sidebar-menu > .nav-treeview").children(0).addClass('active');


    // language switcher menu active
    $('.p-0 a').filter(function() {
      return this.href == "{{ url('setlocale/' . \Session::get('locale')) }}";
    }).addClass('active');


    // menu search autocomplete
    $( "#search" ).autocomplete({
      source: "{{ route('search') }}",
      minLength: 1,
      focus: function( event, ui ) {
        $( "#search" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#search" ).val( ui.item.label );
        window.location.href = ui.item.id;
        return false;
      }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };;
  });
</script>
</body>
</html>
