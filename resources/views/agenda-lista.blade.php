@extends('layouts.inicio')

@section('sidebar', 'sidebar-collapse')

@section('contenido')
<div class="row">
		
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">{{ucfirst($estado)}} <span data-toggle="tooltip" title="{{count($operaciones)}} Operaciones" class="badge bg-green">{{count($operaciones)}}</span></h3>
			</div>			

			<div class="box-body table-responsive no-padding">

				<div class="col-md-6">
					<form action="{{route('operaciones_fechas', $estado, 'desde', 'hasta')}}" method="POST">
						@csrf
			          	<div class="form-group col-md-12" style="margin-bottom: 0px;">
							<div class="form-group col-md-4">						
								<label for="txtNombre">Desde</label>
								<div id="inputDesde">
									<input type="date" class="form-control" name="desde" value="{{old('desde', $desde)}}">
								</div>						
							</div>
							<div class="form-group col-md-4" style="margin-bottom: 0px;">						
								<label for="txtApellido">Hasta</label>
								<div id="inputHasta">
									<input type="date" class="form-control" name="hasta" value="{{old('hasta', $hasta)}}">
								</div>						
							</div>

							<div class="form-group col-md-4" style="margin-top:25px">
	            				<button type="submit" class="btn btn-primary">Buscar</button>		
							</div>

			            </div>	
					</form>
				</div>

				<div class="col-md-6" style="float: auto;">
					<div class="pull-right" style="margin-top:25px;">
						<form action="{{route('export_excel')}}" method="POST">
						@csrf
						<input type="hidden" name="desde" value="{{$desde}}">
						<input type="hidden" name="hasta" value="{{$hasta}}">
						<input type="hidden" name="operaciones" value="{{$operaciones}}">
		            	<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp; Exportar</button>
						</form>
					</div>
				</div>


				<table class="table table-hover">
					<tbody>
					<tr style="background-color: #e6e6e6; font-size: 12px">
						<th></th>
						<!-- <th>Id</th> -->
						<!-- <th>Chasis</th> -->
						<th>Cliente</th>
						<th>Preventa</th>
						<th>Grupo y Orden</th>
						<th>Marca</th>
						<th>Modelo</th>
						<!-- <th>Color</th> -->
						<!-- <th>Vin</th> -->
						<!-- <th>Telefono1</th> -->
						<!-- <th>Telefono2</th> -->
						<!-- <th>Telefono3</th> -->
						<!-- <th>Email</th> -->
						<th>Fecha Entrega</th>
						<th>Hora Entrega</th>
						<th>Sede Entrega</th>
						<th>Usuario Alta</th>
						<th>Fecha Alta</th>
						<th>Fecha Reprogr.</th>
						@if($estado == 'pendientes')
						<th colspan="4" class="text-center"></th>
						@else
						<th class="text-center"></th>
						@endif
						<!-- <th>Acciones</th> -->
					</tr>
					@foreach($operaciones as $operacion)
					<tr style="font-size: 12px">
						<td>
							@switch($operacion->semaforo)
							@case(0)
								<span class="badge bg-green">B</span>
								@break
							@case(1)
								<span class="badge bg-yellow">M</span>
								@break
							@case(2)
								<span class="badge bg-red">A</span>
								@break
							@endswitch
						</td>
						<!-- <td>{{$operacion->id}}</td> -->
						<!-- <td>{{$operacion->chasis}}</td> -->
						<td>{{$operacion->ApeNom()}}</td>
						<td>{{$operacion->nro_preventa}}</td>
						<td class="text-center">{{$operacion->GrupoOrden()}}</td>
						<td>{{$operacion->marca->nombre}}</td>
						<td>{{$operacion->modelo}}</td>
						<!-- <td>{{$operacion->color}}</td>
						<td>{{$operacion->vin}}</td>
						<td>{{$operacion->telefono1}}</td>
						<td>{{$operacion->telefono2}}</td>
						<td>{{$operacion->telefono3}}</td>
						<td>{{$operacion->email}}</td> -->
						<!-- <td>{{$operacion->semaforo_color()}}</td> -->
						<td class="text-center"><strong>{{$operacion->fecha_entrega()}}</strong></td>
						<td class="text-center"><strong>{{$operacion->hora_entrega()}}
							@if($operacion->estado == 0)
								@switch(true)				
								@case($operacion->alerta_entrega() < 0 && $operacion->alerta_entrega() > -3)
									<i class="fa fa-fw fa-warning text-yellow"></i>
									@break
								@case($operacion->alerta_entrega() > 0)
									<i class="fa fa-fw fa-warning text-red"></i>
									@break
								@endswitch
							@endif
							</strong>
						</td>
						<td>{{$operacion->sede_entrega->nombre}}</td>
						<th>{{$operacion->usuario_alta}}</th>
						<th>{{$operacion->created_at_format('d-m-Y')}}</th>
						<th>{{$operacion->fecha_alta_reprogramacion_format('d-m-Y')}}</th>
						<td class="text-center">
				            <a href="#" title="Ver Observación" role="button" data-toggle="modal" data-target="#obs-{{$operacion->id}}" class="btn btn-info btn-sm {{(count($operacion->observaciones) == 0) ? 'disabled' : ''}}"><i class="fa fa-commenting-o"></i></a>
						</td>
						@if($estado == 'pendientes')
						<td class="text-center">
				            <a href="{{route('agenda_mostrar', $operacion)}}" title="Editar Operación" role="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
						</td>
						<td class="text-center">
				            <a href="{{route('agenda_mostrar_entrega', $operacion)}}" title="Editar Sede y Fecha de Entrega" role="button" class="btn btn-primary btn-sm"><i class="fa fa-calendar"></i></a>
						</td>
						<td class="text-center"><a class="btn btn-default btn-sm" href="#" title="Marcar como Entregado" role="button" data-toggle="modal" data-target="#modal-{{$operacion->id}}"><strong>Entregar</strong></a></td>
						@endif
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>


	@if($estado == 'pendientes')
	@foreach($operaciones as $operacion)
	
    <div class="modal fade" id="modal-{{$operacion->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Confirmación de la operación</h4>
          </div>
          <div class="modal-body">
            <p>¿Seguro desea cambiar el estado de {{$operacion->ApeNom()}} a Entregado?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <form action="{{route('agenda_entregar')}}" method="POST">
            	@csrf
            	<input type="hidden" name="_method" value="PUT">
            	<input type="hidden" name="operacion_id" value="{{$operacion->id}}">
            	<input type="hidden" name="entregado" value="1">
            	<input type="submit" class="btn btn-primary" value="Guardar Estado">
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

		@if(count($operacion->observaciones) > 0)
	    <div class="modal fade" id="obs-{{$operacion->id}}">
	      <div class="modal-dialog">
	        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Observaciones</h4>
	          </div>
	          <div class="modal-body">
				<table class="table table-condensed">
					<tbody>
					<tr>
						<th style="width: 150px">Alta</th>
						<th>Descripcion</th>
						<th style="width: 100px">Usuario</th>
					</tr>

					@foreach($operacion->observaciones as $observacion)
					<tr>
						<td>{{$observacion->created_at_format('d-m-Y H:i')}}</td>
						<td>{{$observacion->descripcion}}</td>
						<td>{{$observacion->usuario_alta}}</td>
					</tr>
		    		@endforeach

					</tbody>
          		</table>
	          </div>
	        </div>
	        <!-- /.modal-content -->
	      </div>
	      <!-- /.modal-dialog -->
	    </div>
	    <!-- /.modal -->
	    @endif

	@endforeach
	@endif


@endsection