@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>403 Forbidden</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">403 Forbidden</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 403</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Forbidden.</h3>

        <p>
          User does not have the right permissions.
        </p>

        <form class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <!-- /.input-group -->
        </form>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  <!-- /.content -->
@endsection
