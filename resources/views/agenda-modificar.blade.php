@extends('layouts.inicio')

@section('contenido')

<div class="row">
	<div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Modificación de Datos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('agenda_modificar')}}">
        	@csrf
            <input type="hidden" name="_method" value="PUT">
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
			<h4>Datos del Cliente</h4>
			<hr class="hr-primary">				

          	<div class="form-group col-md-12">
				<div class="form-group col-md-6">						
					<label for="txtNombre">Nombre</label>
					<div id="txtNombre">
						<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{old('nombre', $operacion->nombre)}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtApellido">Apellido</label>
					<div id="txtApellido">
						<input type="text" class="form-control" placeholder="Apellido" name="apellido" value="{{old('apellido', $operacion->apellido)}}">
					</div>						
				</div>
            </div>			

          	<div class="form-group col-md-12">
				<div class="form-group col-md-4">						
					<label for="txtTelefono1">Telefono 1</label>
					<div id="txtTelefono1">
						<input type="text" class="form-control" placeholder="Numero" name="telefono1" value="{{old('telefono1', $operacion->telefono1)}}">
					</div>						
				</div>
				<div class="form-group col-md-4">						
					<label for="txtTelefono2">Telefono 2</label>
					<div id="txtTelefono2">
						<input type="text" class="form-control" placeholder="Numero" name="telefono2" value="{{old('telefono2', $operacion->telefono2)}}">
					</div>						
				</div>
				<div class="form-group col-md-4">						
					<label for="txtTelefono3">Telefono 3</label>
					<div id="txtTelefono3">
						<input type="text" class="form-control" placeholder="Numero" name="telefono3" value="{{old('telefono3', $operacion->telefono3)}}">
					</div>						
				</div>
            </div>

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">						
					<label for="txtMail">E-Mail</label>
					<div id="txtMail">
						<input type="mail" class="form-control" placeholder="email" name="email" value="{{old('email', $operacion->email)}}">
					</div>						
				</div>

				<div class="form-group col-md-6">
	          		<label for="radioSemaforo3">Prioridad</label>
	          		<div id="radioSemaforo3">

						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo3" value="2" {{old('semaforo', $operacion->semaforo) == 2 ? 'checked' : ''}}>
								<span class="badge bg-red" style="padding: 3px 15px;">Alta</span>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo2" value="1" {{old('semaforo', $operacion->semaforo) == 1 ? 'checked' : ''}}>
								<span class="badge bg-yellow" style="padding: 3px 10px;">Normal</span>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="radio">
								<label>
									<input type="radio" name="semaforo" id="optionSemaforo1" value="0" {{old('semaforo', $operacion->semaforo) == 0 ? 'checked' : ''}}>
								<span class="badge bg-green" style="padding: 3px 15px;">Baja</span>
								</label>
							</div>
						</div>

	          		</div>
	            </div>
        	</div>

			<h4>Datos del Vehículo</h4>
			<hr class="hr-primary">	

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">						
					<label for="txtChasis">Chasis</label>
					<div id="txtChasis">
						<input type="text" class="form-control" placeholder="Chasis" name="chasis" value="{{old('chasis', $operacion->chasis)}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtVin">VIN</label>
					<div id="txtVin">
						<input type="text" class="form-control" placeholder="VIN" name="vin" value="{{old('vin', $operacion->vin)}}">
					</div>						
				</div>
			</div>

			<div class="form-group col-md-12">	
				<div class="form-group col-md-6">						
					<label for="txtModelo">Modelo</label>
					<div id="txtModelo">
						<input type="text" class="form-control" placeholder="Modelo" name="modelo" value="{{old('modelo', $operacion->modelo)}}">
					</div>						
				</div>
				<div class="form-group col-md-6">						
					<label for="txtColor">Color</label>
					<div id="txtColor">
						<input type="text" class="form-control" placeholder="Color" name="color" value="{{old('color', $operacion->color)}}">
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
						<select class="form-control" name="sede_entrega" disabled>
							@foreach($sedes_entrega as $sede)
							@if($operacion->sede_entrega_id == $sede->id)
							<option value="{{$sede->id}}" selected>{{$sede->nombre}}</option>
							@else
							<option value="{{$sede->id}}">{{$sede->nombre}}</option>
							@endif
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
			                  <input type="text" class="form-control pull-right" id="datepicker" name="fecha_entrega" value="{{$operacion->fecha_entrega('d/m/Y')}}" disabled>
			                </div>
						</div>

						<div class="col-md-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
								  <div class="input-group">
								    <div class="input-group-addon">
								      <i class="fa fa-clock-o"></i>
								    </div>
								    <input type="text" class="form-control timepicker" id="hora_entrega" name="hora_entrega" value="{{$operacion->hora_entrega('G:i A')}}" disabled>
								  </div>
								  <!-- /.input group -->
								</div>
								<!-- /.form group -->
							</div>
						</div>

					</div>					
				</div>

			</div>

			<br>
			<h4>Accesorios</h4>
			<hr class="hr-primary">	

          <div class="form-group col-md-12">
              @foreach($accesorios as $accesorio)
              <div class="col-md-3 col-xs-6">
              <label>
	              <input type="checkbox" class="flat-red" name="acc[{{$accesorio->id}}]" {{($accesorio->encuentraAccesorio($operacion_accesorios)) ? 'checked' : ''}}>
				  <span style="font-size: 12px;">{{$accesorio->nombre}}</span>
	           </label>
              </div>
		  	  @endforeach
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