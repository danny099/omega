@extends('index')

@section('contenido')
<!-- Main content -->
@if(Auth::user()->id == 1)
<div class="row">
  <div class="col-md-12">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$contratos}}</h3>

              <p>Contratos</p>
            </div>
            <div class="icon">
              <i class="ion ion-document"></i>
            </div>
            <a href="{{ url('administrativas') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$clientes}}</h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion-ios-people"></i>
            </div>
            <a href="{{ url('clientes') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$usuarios}}</h3>

              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-person"></i>
            </div>
            <a href="{{ url('usuarios') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$auditorias}}</h3>

              <p>Cambios realizados</p>
            </div>
            <div class="icon">
              <i class="ion-ios-paper"></i>
            </div>
            <a href="{{ url('auditorias') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
@endif
@endsection
