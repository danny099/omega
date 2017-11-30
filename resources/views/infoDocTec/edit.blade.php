@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('criterio/disSimp') }}">Informe tecnico detallado</a></li>
    <li class="active">Editar informe tecnico detallado</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Editar informe tecnico detallado</h3>
      </div>
      @if(Session::has('message'))
        <div id="alert">
          <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
          <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
          </div>
        </div>
      @endif
      <!-- /.box-header -->
      <!-- form start -->
        <div class="row">
          <form class="" action="{{ url('criterio/update') }}" method="post">
            {{ csrf_field() }}
            <div class="col-md-12">
              <div class="col-md-6">
                <label>Items</label>

              </div>
              <div class="col-md-1">
                <label>Aplica</label>

              </div>
              <div class="col-md-1">
                <label >Cumple</label>

              </div>
              <div class="col-md-4" >
                <label >Observaciones</label>
              </div>
            </div>

            @foreach($criterios as $key=>$criterio)
              <div class="col-md-12 well" style="width:95%; margin-left:30px">
                <div class="col-md-6">
                  <p>{{$criterio->items->item}}</p>

                </div>
                <div class="col-md-1">
                  @if($criterio->aplica == "Si")
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="Si" checked="checked" >Si</label>
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="No" >No</label>
                  @elseif($criterio->aplica == "No")
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="Si"  >Si</label>
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="No" checked="checked" >No</label>
                  @else
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="Si"  >Si</label>
                    <label class="radio-inline"><input type="radio" name="aplica[][{{$key}}]" value="No" >No</label>
                  @endif

                </div>
                <div class="col-md-1">
                  @if($criterio->cumple == "Si")
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="Si" checked="checked" >Si</label>
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="No">No</label>
                  @elseif($criterio->cumple == "No")
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="Si" >Si</label>
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="No" checked="checked">No</label>
                  @else
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="Si" >Si</label>
                    <label class="radio-inline"><input type="radio" name="cumple[][{{$key}}]" value="No">No</label>
                  @endif
                </div>
                <div class="col-md-4" >
                  <textarea class="form-control" rows="5"  name="observaciones[][{{$key}}]" value="{{$criterio->observaciones}}"></textarea>          

                  <input type="hidden" name="id_criterio[]" value="{{$criterio->id}}">

                </div>
              </div>
            @endforeach
            <div class="box-footer" style="width:95%; margin-left:40px; margin-bottom:15px">
              <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
            </div>
          </form>
        </div>
        </div>
        <!-- /.box-body -->
        <br>

    </div>
  </div>

@endsection

@section('scripts')


@endsection
