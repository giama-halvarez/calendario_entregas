<?php

namespace App\Http\Controllers;

use App\Operacion;
use App\Marca;
use App\TipoOperacion;
use App\SedeEntrega;
use App\Accesorio;
use App\OperacionAccesorio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OperacionRequest;
use Illuminate\Http\Request;

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
        switch ($estado) {
            case 'pendientes':
                $operaciones = Operacion::where('estado','=','0')->orderBy('fecha_calendario_entrega')->get();
                break;
            case 'entregados':                
                $operaciones = Operacion::where('estado','=','1')->orderBy('fecha_calendario_entrega')->get();
                break;
            default:                
                $operaciones = Operacion::orderBy('fecha_calendario_entrega')->get();
                break;
        }
        
        //dd($operaciones->toArray());

        return view('agenda-lista',compact('operaciones', 'estado'));
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
        $op->estado = $request->estado;

        $op->save();

        $last_id = DB::getPDO()->lastInsertId();
        
        foreach ($request->acc as $key => $value) {
            $op_acc = new OperacionAccesorio;
            $op_acc->operacion_id = $last_id;
            $op_acc->accesorio_id = $key;

            $op_acc->save();
        }

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
        $op->estado = $request->estado;

        $op->save();

        $last_id = DB::getPDO()->lastInsertId();
        
        foreach ($request->acc as $key => $value) {
            $op_acc = new OperacionAccesorio;
            $op_acc->operacion_id = $last_id;
            $op_acc->accesorio_id = $key;

            $op_acc->save();
        }

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
    public function show(Operacion $operacion)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operacion  $operacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operacion $operacion)
    {
        //
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
}
