@extends('layouts.inicio')

@section('contenido')

<div class="row">
	<div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Modificación de Entrega</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('agenda_modificar_entrega', $operacion)}}">
        	@csrf
        	@method('PUT')
        	@if($errors->any())
        	<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i>Los datos ingresados contienen errores</h4>
        		<ul>@foreach($errors->all() as $error)
					<li>{{$error}}</li>
        			@endforeach
        		</ul>
             </div>
        	@endif
          <div class="box-body">

          	<input type="hidden" name="id" value="{{$operacion->id}}">

          	<div class="form-group col-md-6">
          		<label for="radioMarca">Marca</label>
          		<div id="radioMarca">
					@foreach($marcas as $marca)
					<div class="col-md-4">
						<div class="radio">
							<label>
								<input type="radio" name="marca_id" id="optionsMarca{{$marca->id}}" value="{{$marca->id}}" {{$operacion->marca_id == $marca->id ? 'checked' : ''}} disabled>
							{{$marca->nombre}}
							</label>
						</div>
					</div>
					@endforeach
          		</div>
            </div>

          	<div class="form-group col-md-6">
          		<label for="radioTipo">Tipo de Operacion</label>
          		<div id="radioTipo">
					@foreach($tipos_operacion as $tipoop)
					<div class="col-md-4">
						<div class="radio">
							<label>
								<input type="radio" name="tipo_operacion" id="optionsTipo{{$tipoop->id}}" value="{{$tipoop->id}}" {{$operacion->tipo_operacion == $tipoop->id ? 'checked' : ''}} disabled>
							{{$tipoop->nombre}}
							</label>
						</div>
					</div>
					@endforeach
          		</div>
            </div>


          	<div class="form-group col-md-6">
				<div class="form-group">
					<label for="txtGrupoOrden">Grupo y Orden</label>
					<div id="txtGrupoOrden">
						<div class="col-md-6">
							<input type="text" class="form-control" id="txtgrupo" placeholder="Grupo" name="grupo" value="{{$operacion->grupo}}" disabled>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="txtorden" placeholder="Orden" name="orden" value="{{$operacion->orden}}" disabled>
						</div>
					</div>					
				</div>
            </div>

          	<div class="form-group col-md-6">
				<div class="form-group">
					<label for="txtPreVenta">Numero Pre Venta</label>
					<div id="txtPreVenta">
						<div class="col-md-12">
							<input type="text" class="form-control" id="txtpreventa" placeholder="Numero Pre Venta" name="nro_preventa" value="{{$operacion->nro_preventa}}" disabled>
						</div>
					</div>						
				</div>
            </div>

			<br>
			<h4>Datos de la Entrega</h4>
			<hr class="hr-primary">	

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">
					<label for="txtSedeEntrega">Sede de Entrega</label>
					<div id="txtSedeEntrega">
						<select class="form-control" name="sede_entrega">
							@foreach($sedes_entrega as $sede)
							<option value="{{$sede->id}}" {{old('sede_entrega', $operacion->sede_entrega_id) == $sede->id ? 'selected' : ''}}>{{$sede->nombre}}</option>
							@endforeach
						</select>
					</div>						
				</div>
				<div class="form-group col-md-6">
					<label for="dateFechaEntrega">Fecha de Entrega <span style="font-weight: normal;">(entre {{env('PARAMETER_HORARIO_DESDE')}} y {{env('PARAMETER_HORARIO_HASTA')}})</span></label>
					<div id="dateFechaEntrega">
						<div class="col-md-8">
							<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" id="datepicker" name="fecha_entrega" onchange="completaFechas();" value="{{old('fecha_entrega', $operacion->fecha_entrega('d/m/Y'))}}">
			                </div>
						</div>

						<div class="col-md-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
								  <div class="input-group">
								    <div class="input-group-addon">
								      <i class="fa fa-clock-o"></i>
								    </div>
								    <input type="text" class="form-control timepicker" id="hora_entrega" name="hora_entrega" onchange="completaFechas();" value="{{old('hora_entrega', $operacion->hora_entrega('G:i A'))}}">
								  </div>
								  <!-- /.input group -->
								</div>
								<!-- /.form group -->
							</div>
						</div>

					</div>					
				</div>

				<input type="hidden" id="fecha_calendario_entrega" name="fecha_calendario_entrega" value="{{old('fecha_calendario_entrega', $operacion->fecha_calendario_entrega_format('d/m/Y G:i A'))}}">

			</div>

		  </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </form>
      </div>
      <!-- /.box -->

    </div>

</div>

@endsection

@section('extras_js')
<script>	
  function seleccionaTipoOperacion($tipo){
      document.getElementById('txtgrupo').disabled = true;
      document.getElementById('txtorden').disabled = true;
      document.getElementById('txtpreventa').disabled = true;
  }
</script>
@endsection