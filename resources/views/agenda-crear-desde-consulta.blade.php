@extends('layouts.inicio')

@section('contenido')

<div class="row">
	<div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Nueva Entrega</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('guardar_desde_consulta')}}">
        	@csrf
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

          	<div class="form-group col-md-6">
          		<label for="radioMarca">Marca</label>
          		<input type="hidden" name="marca_id" value="{{$marcax}}">
          		<div id="radioMarca">
					@foreach($marcas as $marca)
					<div class="col-md-4">
						<div class="radio">
							<label>
								<input type="radio" name="marca_id" disabled="true" id="optionsMarca{{$marca->id}}" value="{{$marca->id}}"{{ $marcax == $marca->id ? 'checked' : ''}}>
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
          		<input type="hidden" name="tipo_operacion" value="{{$tipo_operacionx}}">
					@foreach($tipos_operacion as $tipoop)
					<div class="col-md-4">
						<div class="radio">
							<label>
								<input type="radio" name="tipo_operacion" disabled="true" id="optionsTipo{{$tipoop->id}}" value="{{$tipoop->id}}" onchange="seleccionaTipoOperacion('{{$tipoop->id}}');" {{ old('tipo_operacion', $tipo_operacionx) == $tipoop->id ? 'checked' : ''}}>
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
							@if($tipo_operacionx == 1)
          					<input type="hidden" name="grupo" value="{{$operacion->Grupo}}">
          					@endif
							<input type="text" class="form-control" id="txtgrupo2" placeholder="Grupo" name="grupo" disabled="true" value="{{$operacion->Grupo}}">
						</div>
						<div class="col-md-6">
							@if($tipo_operacionx == 1)
          					<input type="hidden" name="Orden" value="{{$operacion->Orden}}">
          					@endif
							<input type="text" class="form-control" id="txtorden2" placeholder="Orden" name="orden" disabled="true" value="{{$operacion->Orden}}">
						</div>
					</div>					
				</div>
            </div>

          	<div class="form-group col-md-6">
				<div class="form-group">
					<label for="txtPreVenta">Numero Pre Venta</label>
					<div id="txtPreVenta">
						<div class="col-md-12">
							@if($tipo_operacionx == 2)
          					<input type="hidden" name="nro_preventa" value="{{$operacion->NroPreventa}}">
          					@endif
							<input type="text" class="form-control" id="txtpreventa2" placeholder="Numero Pre Venta" name="nro_preventa" disabled="true" value="{{$operacion->NroPreventa}}">
						</div>
					</div>						
				</div>
            </div>

			<br>
			<h4>Datos del Cliente</h4>
			<hr class="hr-primary">				

          	<div class="form-group col-md-12">
				<div class="form-group col-md-6">						
					<label for="txtNombre">Nombre</label>
					<div id="txtNombre">
						<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{(old('nombre') == '') ? $operacion->Nombres : old('nombre')}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtApellido">Apellido</label>
					<div id="txtApellido">
						<input type="text" class="form-control" placeholder="Apellido" name="apellido" value="{{(old('apellido') == '') ? $operacion->Apellido : old('apellido')}}">
					</div>						
				</div>
            </div>			

          	<div class="form-group col-md-12">
				<div class="form-group col-md-4">						
					<label for="txtTelefono1">Telefono 1</label>
					<div id="txtTelefono1">
						<input type="text" class="form-control" placeholder="Numero" name="telefono1" value="{{(old('telefono1') == '')  ? $operacion->Telefonos1 : old('telefono1')}}">
					</div>						
				</div>
				<div class="form-group col-md-4">						
					<label for="txtTelefono2">Telefono 2</label>
					<div id="txtTelefono2">
						<input type="text" class="form-control" placeholder="Numero" name="telefono2" value="{{(old('telefono2') == '')  ? $operacion->Telefonos2 : old('telefono2')}}">
					</div>						
				</div>
				<div class="form-group col-md-4">						
					<label for="txtTelefono3">Telefono 3</label>
					<div id="txtTelefono3">
						<input type="text" class="form-control" placeholder="Numero" name="telefono3" value="{{(old('telefono3') == '') ? $operacion->Telefonos3 : old('telefono3')}}">
					</div>						
				</div>
            </div>

          	<div class="form-group col-md-12">
				<div class="form-group col-md-6">						
					<label for="txtMail">E-Mail</label>
					<div id="txtMail">
						<input type="mail" class="form-control" placeholder="email" name="email" value="{{(old('email') == '') ? $operacion->Email : old('email')}}">
					</div>						
				</div>

				<div class="form-group col-md-6">
	          		<label for="radioSemaforo3">Prioridad</label>
	          		<div id="radioSemaforo3">

						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo3" value="2">
								<span class="badge bg-red" style="padding: 3px 15px;">Alta</span>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo2" value="1" checked>
								<span class="badge bg-yellow" style="padding: 3px 10px;">Normal</span>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo1" value="0">
								<span class="badge bg-green" style="padding: 3px 15px;">Baja</span>
								</label>
							</div>
						</div>

	          		</div>
	            </div>
        	</div>

			<br>
			<h4>Datos del Vehículo</h4>
			<hr class="hr-primary">	

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">						
					<label for="txtChasis">Chasis</label>
					<div id="txtChasis">
						<input type="text" class="form-control" placeholder="Chasis" name="chasis" value="{{(old('chasis') == '') ? $operacion->Chasis : old('chasis')}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtVin">VIN</label>
					<div id="txtVin">
						<input type="text" class="form-control" placeholder="VIN" name="vin" value="{{(old('vin') == '') ? $operacion->VIN : old('vin')}}">
					</div>						
				</div>
			</div>

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">						
					<label for="txtModelo">Modelo</label>
					<div id="txtModelo">
						<input type="text" class="form-control" placeholder="Modelo" name="modelo" value="{{(old('modelo') == '') ? $operacion->Modelo : old('modelo')}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtColor">Color</label>
					<div id="txtColor">
						<input type="text" class="form-control" placeholder="Color" name="color" value="{{(old('color') == '') ? $operacion->Color : old('color')}}">
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
							<option value="{{$sede->id}}">{{$sede->nombre}}</option>
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
			                  <input type="text" class="form-control pull-right" id="datepicker" name="fecha_entrega" onchange="completaFechas();" value="{{old('fecha_entrega')}}" autocomplete="off">
			                </div>
						</div>

						<div class="col-md-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
								  <div class="input-group">
								    <div class="input-group-addon">
								      <i class="fa fa-clock-o"></i>
								    </div>
								    <input type="text" class="form-control timepicker" id="hora_entrega" name="hora_entrega" onchange="completaFechas();" value="{{old('hora_entrega')}}">
								  </div>
								  <!-- /.input group -->
								</div>
								<!-- /.form group -->
							</div>
						</div>

					</div>					
				</div>

				<input type="hidden" id="fecha_calendario_entrega" name="fecha_calendario_entrega" value="">

				<input type="hidden" id="estado" name="estado" value="0">

			</div>

			<br>
			<h4>Accesorios</h4>
			<hr class="hr-primary">	

			<div class="form-group col-md-12">
				@foreach($accesorios as $accesorio)
				<div class="col-md-3 col-xs-6">
					<label>
						<input type="checkbox" class="flat-red" name="acc[{{$accesorio->id}}]">
						<span style="font-size: 12px;">{{$accesorio->nombre}}</span>
					</label>
				</div>	
				@endforeach
			</div>

          	<div class="form-group col-md-12">
				<div class="form-group col-md-12">						
					<label for="txtAccesorios"> Otros Accesorios</label>
					<div id="txtAccesorios">
						<textarea class="form-control" rows="4" placeholder="Accesorios" name="otros_accesorios">{{old('otros_accesorios', html_entity_decode(implode('&#13;&#10;', (array)$operacion->accesorios)))}}</textarea>
					</div>						
				</div>
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
    if ($tipo == 1) {
      document.getElementById('txtgrupo').disabled = false;
      document.getElementById('txtorden').disabled = false;
      document.getElementById('txtpreventa').disabled = true;

      document.getElementById('txtpreventa').value = '';
    }
    if ($tipo == 2){
      document.getElementById('txtgrupo').disabled = true;
      document.getElementById('txtorden').disabled = true;
      document.getElementById('txtpreventa').disabled = false;
      
      document.getElementById('txtgrupo').value = '';
      document.getElementById('txtorden').value = '';
    }
  }
</script>
@endsection