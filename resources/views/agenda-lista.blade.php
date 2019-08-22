@extends('layouts.inicio')

@section('contenido')
<div class="row">
		
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">{{ucfirst($estado)}}</h3>
			</div>
			<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<tbody>
			<tr>
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
				<th>Editar</th>
				@if($estado == 'pendientes')
				<th></th>
				@endif
				<!-- <th>Acciones</th> -->
			</tr>
			@foreach($operaciones as $operacion)
			<tr>
				<td>
					@switch($operacion->semaforo)
					@case(0)
						<span class="badge bg-green">V</span>
						@break
					@case(1)
						<span class="badge bg-yellow">A</span>
						@break
					@case(2)
						<span class="badge bg-red">R</span>
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
						@case($operacion->alerta_entrega() > 0 && $operacion->alerta_entrega() < 3)
							<i class="fa fa-fw fa-warning text-yellow"></i></strong>
							@break
						@case($operacion->alerta_entrega() > 0)
							<i class="fa fa-fw fa-warning text-red"></i></strong>
							@break
						@endswitch
					@endif
				</td>
				<td>{{$operacion->sede_entrega->nombre}}</td>
				<td class="text-center"><a class="btn btn-primary btn-sm" href="#" role="button"><i class="fa fa-pencil"></i></a></td>
				@if($estado == 'pendientes')
				<td class="text-center"><a class="btn btn-default btn-sm" href="#" role="button" onclick="return confirm('¿Desea pasar la operacion de {{$operacion->ApeNom()}} a entregado?')"><strong>Entregar</strong></a></td>
				@endif
			</tr>
			@endforeach
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>

@endsection