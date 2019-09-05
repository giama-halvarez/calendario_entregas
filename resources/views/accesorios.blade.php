@extends('layouts.inicio')

@section('contenido')
<div class="row">

  @if($errors->any())
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i>Ocurrio un error al guardar el accesorio</h4>
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
		
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Accesorios</h3>
			</div>
			<div class="box-body table-responsive no-padding">
			<a href="#" role="button" class="btn btn-primary" style="margin-left: 3px;" data-toggle="modal" data-target="#modal-new-accesorio">Nuevo accesorio</a><br>
		<table class="table table-hover" style="margin-top: 10px;">
			<tbody>
			<tr style="background-color: #e6e6e6;">
				<th class="col-md-1">Codigo</th>
				<th>Nombre</th>
				<th colspan="2" class="text-center col-md-2 col-xs-2"></th>
				<!-- <th>Acciones</th> -->
			</tr>
			@foreach($accesorios as $accesorio)
			<tr>
				<td>{{$accesorio->id}}</td>
				<td>{{$accesorio->nombre}}</td>
				<td class="text-center">
		            <a href="#" role="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-edit-{{$accesorio->id}}"><i class="fa fa-pencil"></i> Editar</a>
				</td>
				<td class="text-center">
		            <a href="#" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-delete-{{$accesorio->id}}"><i class="fa fa-remove"></i> Eliminar</a>
				</td>
			</tr>
			@endforeach
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>


	
    <div class="modal fade" id="modal-new-accesorio">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Alta de Accesorio</h4>
          </div>
          <form action="{{route('accesorios.store', $accesorio)}}" method="POST">
            @csrf
	          <div class="modal-body">

              <div class="form-group">
                <label for="txtNombre">Nombre del accesorio</label>
                <div id="txtNombre">
                  <div class="col-md-12">
                    <input type="text" class="form-control" id="txtNombre" placeholder="Nombre" name="nombre" >
                  </div>
                </div>            
              </div>

	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
	            	<input type="submit" class="btn btn-primary" value="Guardar">
	          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


	@foreach($accesorios as $accesorio)
	
    <div class="modal fade" id="modal-edit-{{$accesorio->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modificar accesorio</h4>
          </div>
          <form action="{{route('accesorios.update', $accesorio)}}" method="POST">
            @csrf @method('PATCH')
            <div class="modal-body">

              <div class="form-group">
                <label for="txtNombre">Nombre del accesorio</label>
                <div id="txtNombre">
                  <div class="col-md-12">
                    <input type="text" class="form-control" id="txtNombre" placeholder="Nombre" name="nombre" value="{{$accesorio->nombre}}" required>
                  </div>
                </div>            
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modal-delete-{{$accesorio->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar accesorio</h4>
          </div>
          <div class="modal-body">
            <p>¿Seguro desea eliminar el accesorio?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <form action="{{route('accesorios.destroy', $accesorio)}}" method="POST">
            	@csrf @method('DELETE')
            	<input type="submit" class="btn btn-primary" value="Eliminar">
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

	@endforeach


@endsection