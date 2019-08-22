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
        <form role="form" method="GET" action="{{route('crear_desde_consulta')}}">
        	@csrf
        	@if($errors->any())
        	<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close"role="alert" data-auto-dismiss="2000" aria-hidden="true">×</button>
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
          		<div id="radioMarca">
					@foreach($marcas as $marca)
					<div class="col-md-4">
						<div class="radio">
							<label>
								<input type="radio" name="marca_id" id="optionsMarca{{$marca->id}}" value="{{$marca->id}}" {{ old('optionsMarca') == $marca->id ? 'checked' : ''}}>
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
								<input type="radio" name="tipo_operacion" id="optionsTipo{{$tipoop->id}}" value="{{$tipoop->id}}" onchange="seleccionaTipoOperacion('{{$tipoop->id}}');">
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
							<input type="text" class="form-control" id="txtgrupo" placeholder="Grupo" name="grupo" value="{{old('grupo')}}">
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="txtorden" placeholder="Orden" name="orden" value="{{old('orden')}}">
						</div>
					</div>					
				</div>
            </div>

          	<div class="form-group col-md-6">
				<div class="form-group">
					<label for="txtPreVenta">Numero Pre Venta</label>
					<div id="txtPreVenta">
						<div class="col-md-12">
							<input type="text" class="form-control" id="txtpreventa" placeholder="Numero Pre Venta" name="nro_preventa" value="{{old('nro_preventa')}}">
						</div>
					</div>						
				</div>
            </div>


		  </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Consultar</button>
          </div>

        </form>
      </div>
      <!-- /.box -->

    </div>

</div>

@endsection