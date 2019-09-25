<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Http\Requests\EntregaUpdateRequest;
use App\Http\Requests\OperacionRequest;
use App\Http\Requests\OperacionUpdateRequest;
use App\Mail\MessageAltaOperacion;
use App\Marca;
use App\Observacion;
use App\Operacion;
use App\OperacionAccesorio;
use App\SedeEntrega;
use App\TipoOperacion;
use App\Exports\OperacionesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OperacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($estado)
    {
        // 
        $FechaDesde = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $FechaHasta = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


        switch ($estado) {
            case 'pendientes':
                date_add($FechaHasta, date_interval_create_from_date_string('30 days'));

                $operaciones = Operacion::where('estado','=','0')->whereBetween('fecha_calendario_entrega', [$FechaDesde->format('Y-m-d'), $FechaHasta->format('Y-m-d')])->orderBy('fecha_calendario_entrega')->get();
                break;
            case 'entregados':
                date_add($FechaDesde, date_interval_create_from_date_string('-30 days'));

                $operaciones = Operacion::where('estado','=','1')->whereBetween('fecha_calendario_entrega', [$FechaDesde->format('Y-m-d'), $FechaHasta->format('Y-m-d')])->orderBy('fecha_calendario_entrega')->get();
                break;
            default: 
                $operaciones = Operacion::orderBy('fecha_calendario_entrega')->get();
                break;
        }

        $desde = $FechaDesde->format('Y-m-d');
        $hasta = $FechaHasta->format('Y-m-d');
        

        //dd($operaciones->toArray());

        return view('agenda-lista',compact('operaciones', 'estado', 'desde', 'hasta'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFechas(Request $request, $estado)
    {
        // 
        $FechaDesde = \DateTime::createFromFormat('Y-m-d', $request->desde);
        $FechaHasta = \DateTime::createFromFormat('Y-m-d', $request->hasta);


        switch ($estado) {
            case 'pendientes':
                $operaciones = Operacion::where('estado','=','0')->whereBetween('fecha_calendario_entrega', [$FechaDesde->format('Y-m-d'), $FechaHasta->format('Y-m-d')])->orderBy('fecha_calendario_entrega')->get();
                break;
            case 'entregados':
                $operaciones = Operacion::where('estado','=','1')->whereBetween('fecha_calendario_entrega', [$FechaDesde->format('Y-m-d'), $FechaHasta->format('Y-m-d')])->orderBy('fecha_calendario_entrega')->get();
                break;
            default: 
                $operaciones = Operacion::orderBy('fecha_calendario_entrega')->get();
                break;
        }

        $desde = $FechaDesde->format('Y-m-d');
        $hasta = $FechaHasta->format('Y-m-d');
        

        //dd($operaciones->toArray());

        return view('agenda-lista',compact('operaciones', 'estado', 'desde', 'hasta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
        $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();
        $tipos_operacion = (new TipoOperacion)->get_tipos();
        $accesorios = Accesorio::where('activo','=',1)->orderBy('nombre')->get();
        
        return view('agenda-crear', compact('marcas', 'sedes_entrega', 'tipos_operacion', 'accesorios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperacionRequest $request)
    {
        //        
        $op = new Operacion;        
        $fecha = \DateTime::createFromFormat('d/m/Y h:i A', $request->fecha_calendario_entrega);
        $op->estado = $request->estado;
        $op->tipo_operacion = $request->tipo_operacion;
        $op->nro_preventa = $request->nro_preventa;
        $op->grupo = $request->grupo;
        $op->orden = $request->orden;
        $op->nro_preventa = $request->nro_preventa;
        $op->marca_id = $request->marca_id;
        $op->modelo = $request->modelo;
        $op->color = $request->color;
        $op->chasis = $request->chasis;
        $op->vin = $request->vin;
        $op->nombre = $request->nombre;
        $op->apellido = $request->apellido;
        $op->telefono1 = $request->telefono1;
        $op->telefono2 = $request->telefono2;
        $op->telefono3 = $request->telefono3;
        $op->email = $request->email;
        $op->semaforo = $request->semaforo;
        $op->fecha_calendario_entrega = $fecha;
        $op->sede_entrega_id = $request->sede_entrega;
        $op->otros_accesorios = $request->otros_accesorios;
        $op->estado = $request->estado;
        $op->usuario_alta = auth()->user()->name;

        $op->save();

        $last_id = DB::getPDO()->lastInsertId();


        if($request->exists('acc') == true){
            foreach ($request->acc as $key => $value) {
                $op_acc = new OperacionAccesorio;
                $op_acc->operacion_id = $last_id;
                $op_acc->accesorio_id = $key;

                $op_acc->save();
            }
        }    

        Mail::to($op->email)->send(new MessageAltaOperacion(env('MAIL_FROM_ADDRESS'), $op));

        $observacion = new Observacion;
        $observacion->operacion_id = $operacion->id;
        $observacion->descripcion = 'Se ha enviado mail inicial de programacion de entrega';
        $observacion->save();

        return redirect('/agenda/ver/pendientes');
        
    }
     
    public function store_desde_consulta(OperacionRequest $request)
    {
        //
        $op = new Operacion;        
        $fecha = \DateTime::createFromFormat('d/m/Y h:i A', $request->fecha_calendario_entrega);
        $op->estado = $request->estado;
        $op->tipo_operacion = $request->tipo_operacion;
        $op->nro_preventa = $request->nro_preventa;
        $op->grupo = $request->grupo;
        $op->orden = $request->orden;
        $op->nro_preventa = $request->nro_preventa;
        $op->marca_id = $request->marca_id;
        $op->modelo = $request->modelo;
        $op->color = $request->color;
        $op->chasis = $request->chasis;
        $op->vin = $request->vin;
        $op->nombre = $request->nombre;
        $op->apellido = $request->apellido;
        $op->telefono1 = $request->telefono1;
        $op->telefono2 = $request->telefono2;
        $op->telefono3 = $request->telefono3;
        $op->email = $request->email;
        $op->semaforo = $request->semaforo;
        $op->fecha_calendario_entrega = $fecha;
        $op->sede_entrega_id = $request->sede_entrega;
        $op->otros_accesorios = $request->otros_accesorios;
        $op->estado = $request->estado;
        $op->usuario_alta = auth()->user()->name;

        $op->save();

        $last_id = DB::getPDO()->lastInsertId();
        

        if($request->exists('acc') == true){
            foreach ($request->acc as $key => $value) {
                $op_acc = new OperacionAccesorio;
                $op_acc->operacion_id = $last_id;
                $op_acc->accesorio_id = $key;

                $op_acc->save();
            }
        }    

        Mail::to($op->email)->send(new MessageAltaOperacion(env('MAIL_FROM_ADDRESS'), $op));

        $observacion = new Observacion;
        $observacion->operacion_id = $operacion->id;
        $observacion->descripcion = 'Se ha enviado mail inicial de programacion de entrega';
        $observacion->save();

        return redirect('/agenda/ver/pendientes');
        
    }

    public function mostrar_consulta(){

        $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
        $tipos_operacion = (new TipoOperacion)->get_tipos();

        return view('consultar', compact('marcas', 'tipos_operacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Operacion $operacion)
    {
        //
        if ($operacion != null) {

            $operacion_accesorios = OperacionAccesorio::where('operacion_id','=',$operacion->id)->get();

            $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
            $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();
            $tipos_operacion = (new TipoOperacion)->get_tipos();
            $accesorios = Accesorio::where('activo','=',1)->orderBy('nombre')->get();
            
            return view('agenda-modificar', compact('operacion', 'operacion_accesorios', 'marcas', 'sedes_entrega', 'tipos_operacion', 'accesorios'));
        }
        else{
            return redirect()->back()->withErrors(['No se encontro la operación']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function edit_entrega(Operacion $operacion)
    {
        //
        if ($operacion != null) {

            $operacion_accesorios = OperacionAccesorio::where('operacion_id','=',$operacion->id)->get();

            $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
            $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();
            $tipos_operacion = (new TipoOperacion)->get_tipos();
            
            return view('agenda-modificar-entrega', compact('operacion', 'marcas', 'sedes_entrega', 'tipos_operacion', 'accesorios'));
        }
        else{
            return redirect()->back()->withErrors(['No se encontro la operación']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function update(OperacionUpdateRequest $request, Operacion $operacion)
    {
        //
        $operacion = Operacion::where('id','=',$request->id)->first();

        $operacion->nombre = $request->nombre;
        $operacion->apellido = $request->apellido;
        $operacion->telefono1 = $request->telefono1;
        $operacion->telefono2 = $request->telefono2;
        $operacion->telefono3 = $request->telefono3;
        $operacion->email = $request->email;
        $operacion->semaforo = $request->semaforo;
        $operacion->chasis = $request->chasis;
        $operacion->vin = $request->vin;
        $operacion->modelo = $request->modelo;
        $operacion->color = $request->color;
        $operacion->otros_accesorios = $request->otros_accesorios;

        $operacion->save();


        $operacion_accesorios = OperacionAccesorio::where('operacion_id','=',$operacion->id)->delete();
            
        if($request->exists('acc') == true){
            foreach ($request->acc as $key => $value) {
                $op_acc = new OperacionAccesorio;
                $op_acc->operacion_id = $request->id;
                $op_acc->accesorio_id = $key;

                $op_acc->save();
            }   
        }     

        return redirect('/agenda/ver/pendientes');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function update_datos_entrega(Operacion $operacion, EntregaUpdateRequest $request)
    {
        //
        $fecha_entrega = \DateTime::createFromFormat('d/m/Y h: i A', $request->fecha_calendario_entrega);
        //dd($request);
        $datos = [
            "sede_entrega_id" => $request->sede_entrega,
            "fecha_calendario_entrega" => $fecha_entrega,
            "fecha_alta_reprogramacion" => now(),
        ];

        $operacion->update($datos);

        Mail::to($operacion->email)->send(new MessageAltaOperacion(env('MAIL_FROM_ADDRESS'), $operacion));

        $observacion = new Observacion;
        $observacion->operacion_id = $operacion->id;
        $observacion->descripcion = 'Se ha enviado mail de reprogramacion de entrega';
        $observacion->save();

        return redirect('/agenda/ver/pendientes'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function update_entrega(Request $request)
    {
        //
        $operacion = Operacion::where('id','=',$request->operacion_id)->first();

        $operacion->estado = $request->entregado;

        $operacion->save();

        return redirect('/agenda/ver/pendientes'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operacion $operacion)
    {
        //
    }

    public function export(Request $request) 
    {   
        $desde = $request->desde;
        $hasta = $request->hasta;
        $operaciones_array = json_decode($request->operaciones);

        $listado = array();

        foreach ($operaciones_array as $op) {
            $obj = new Operacion;
            $obj->id = $op->id;
            $obj->chasis = $op->chasis;
            $obj->tipo_operacion = $op->tipo_operacion;
            $obj->nro_preventa = $op->nro_preventa;
            $obj->grupo = $op->grupo;
            $obj->orden = $op->orden;
            $obj->marca_id = $op->marca_id;
            $obj->modelo = $op->modelo;
            $obj->color = $op->color;
            $obj->vin = $op->vin;
            $obj->nombre = $op->nombre;
            $obj->apellido = $op->apellido;
            $obj->telefono1 = $op->telefono1;
            $obj->telefono2 = $op->telefono2;
            $obj->telefono3 = $op->telefono3;
            $obj->email = $op->email;
            $obj->semaforo = $op->semaforo;
            $obj->fecha_calendario_entrega = $op->fecha_calendario_entrega;
            $obj->sede_entrega_id = $op->sede_entrega_id;
            $obj->otros_accesorios = $op->otros_accesorios;
            $obj->estado = $op->estado;
            $obj->usuario_alta = $op->usuario_alta;
            $obj->fecha_alta_reprogramacion = $op->fecha_alta_reprogramacion;
            $obj->vendedor = $op->vendedor;

            $oxls = new Operacion();
            $oxls->cliente = $obj->ApeNom();
            $oxls->nro_preventa = $obj->nro_preventa;
            $oxls->grupo_orden = $obj->GrupoOrden();
            $oxls->marca = $obj->marca->nombre;
            $oxls->modelo = $obj->modelo;
            $oxls->fecha_entrega = $obj->fecha_entrega();
            $oxls->hora_entrega = $obj->hora_entrega();
            $oxls->sede_entrega = $obj->sede_entrega->nombre;
            $oxls->accesorios = $obj->accesorios_mostrar();
            $oxls->otros_accesorios = $obj->otros_accesorios;
            $oxls->usuario_alta = $obj->usuario_alta;
            $oxls->fecha_alta = $obj->created_at_format('d-m-Y');
            $oxls->fecha_reprogramacion = $obj->fecha_alta_reprogramacion_format('d-m-Y');

            $listado[] = $oxls;
        }

        $operaciones = collect($listado);

        $nombre_archivo = 'entregas_' . $desde . '_' . $hasta . '.xlsx';

        $titulos = [
            'cliente' => 'Cliente',
            'nro_preventa' => 'Preventa',
            'grupo_orden' => 'Grupo - Orden',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'fecha_entrega' => 'Fecha Entrega',
            'hora_entrega' => 'Hora Entrega',
            'sede_entrega' => 'Sede',
            'accesorios' => 'Accesorios',
            'otros_accesorios' => 'Otros Accesorios',
            'usuario_alta' => 'Alta',
            'fecha_alta' => 'Fecha Alta',
            'fecha_reprogramacion' => 'Fecha de Reprogramación',
        ];

        $export = new OperacionesExport($operaciones, $titulos);

        return $export->download($nombre_archivo);
    }
}
