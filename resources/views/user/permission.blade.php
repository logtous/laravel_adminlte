@extends('layouts.app')

@section('title', __('system.user.permission'))

@section('css')
  <style type="text/css">
    .cate-box{margin-bottom: 15px;padding-bottom:10px;border-bottom: 1px solid #f0f0f0}
    .cate-box dt{margin-bottom: 10px;}
    /*.cate-box dt .cate-first{padding:10px 20px}*/
    .cate-box dd{padding:0 40px}
    .cate-box dd .cate-second{margin-bottom: 10px}
    .cate-box dd .cate-third{padding:0 40px;margin-bottom: 10px}
  </style>
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ __('system.user.permission') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('system.user.permission') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="{{ route('user.assignPermission', $user->id) }}" method="POST">
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
                <label for="inputRole">{{ __('Permission') }}</label>
                <div class="form-control" style="border: 0px; height: 20%">
                  @forelse($permissions as $p1)
                    <dl class="cate-box">
                     <dt>
                       <input id="menu{{$p1->id}}" type="checkbox" name="permissions[]" value="{{$p1->id}}" {{$p1->own??''}} >
                       <label class="form-check-label">@lang($p1->name)</label>
                     </dt>
                      @if($p1->childs->isNotEmpty())
                        @foreach($p1->childs as $p2)
                        <dd>
                          <input id="menu{{$p1->id}}-{{$p2->id}}" type="checkbox" name="permissions[]" value="{{$p2->id}}" {{$p2->own??''}}>
                          <label class="form-check-label">@lang($p2->name)</label>
                          @if($p2->childs->isNotEmpty())
                           <div class="cate-third">
                             @foreach($p2->childs as $p3)
                              <input type="checkbox" id="menu{{$p1->id}}-{{$p2->id}}-{{$p3->id}}" name="permissions[]" value="{{$p3->id}}" {{$p3->own??''}}>
                              <label class="form-check-label">@lang($p3->name)</label>
                             @endforeach
                           </div>
                          @endif
                          </dd>
                        @endforeach
                      @endif
                    </dl>
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

@section('js')
  <script type="text/javascript">
     $( "input[type=checkbox]" ).on( "click", function () {
      var check = $(this).is(':checked');
      var checkId = $(this).attr('id');
      if (check) {
        var ids = checkId.split("-");
        if (ids.length == 3) {
            $("#" + (ids[0] + '-' + ids[1])).prop("checked", true);
            $("#" + (ids[0])).prop("checked", true);
        } else if (ids.length == 2) {
            $("#" + (ids[0])).prop("checked", true);
            $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                $(ele).prop("checked", true);
            });
        } else {
            $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                $(ele).prop("checked", true);
            });
        }
      } else {
        var ids = checkId.split("-");
        if (ids.length == 2) {
            $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                $(ele).prop("checked", false);
            });
        } else if (ids.length == 1) {
            $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                $(ele).prop("checked", false);
            });
        }
      }
    });
  </script>
@endsection
