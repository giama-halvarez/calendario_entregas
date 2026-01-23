<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Operacion_PA_CG;
use App\Marca;
use App\TipoOperacion;
use App\SedeEntrega;
use App\Accesorio;
use App\Http\Requests\ConsultaRequest;

class Operaciones_PA_Controller extends Controller
{
    //

    public function index(ConsultaRequest $request){

        $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
        $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();
        $tipos_operacion = (new TipoOperacion)->get_tipos();
        $accesorios = Accesorio::where('activo','=',1)->orderBy('nombre')->get();

        $marcax = $request->marca_id;
        $tipo_operacionx = $request->tipo_operacion;
        $operacion = null;

        $result = DB::connection('mysql_elysees')->select(
            'SELECT o.Apellido, o.Nombres, o.Telefonos, o.Telefonos2, o.Telefonos2, 
            o.Telefonos3, o.NroChasis, o.EmailParticular, o.Color,
            m.Nombre as DescripModelo, v.Nombre as Vendedor,
            \'-\' as vin
            FROM operaciones o
            LEFT JOIN modelos m ON m.Codigo = o.Modelo
            LEFT JOIN vendedores v ON v.Codigo = o.vendedor
            WHERE Grupo = ? AND Orden = ?'
            , [$request->grupo, $request->orden]
        );

        if(!$result || count($result) == 0) {
            return redirect()->back()->withErrors(['No se encontro la operación']);
        }

        if ($request->tipo_operacion == 1) {

                $operacion = (object) array(
                    'Grupo' => $request->grupo, 
                    'Orden' => $request->orden, 
                    'NroPreventa' => '', 
                    'Apellido' => $result[0]->Apellido, 
                    'Nombres' => $result[0]->Nombres, 
                    'Telefonos1' => $result[0]->Telefonos, 
                    'Telefonos2' => $result[0]->Telefonos2, 
                    'Telefonos3' => $result[0]->Telefonos3, 
                    'Email' => $result[0]->EmailParticular, 
                    'Modelo' => trim($result[0]->DescripModelo),
                    'Color' => trim($result[0]->Color),
                    'Chasis' => trim($result[0]->NroChasis),
                    'VIN' => $result[0]->vin,
                    'Vendedor' => trim($result[0]->Vendedor),
                    'accesorios' => (object) []
                );



        } elseif($request->tipo_operacion == 2) {

            $operacion = (object) array(
                'Grupo' => $request->grupo, 
                'Orden' => $request->orden, 
                'NroPreventa' => '', 
                'Apellido' => $result[0]->Apellido, 
                'Nombres' => $result[0]->Nombres, 
                'Telefonos1' => $result[0]->Telefonos, 
                'Telefonos2' => $result[0]->Telefonos2, 
                'Telefonos3' => $result[0]->Telefonos3, 
                'Email' => $result[0]->EmailParticular, 
                'Modelo' => trim($result[0]->DescripModelo),
                'Color' => trim($result[0]->Color),
                'Chasis' => trim($result[0]->NroChasis),
                'VIN' => $result[0]->vin,
                'Vendedor' => trim($result[0]->Vendedor),
                'accesorios' => (object) []
            );
        } else {
            return redirect()->back()->withErrors(['No se seleccionó el tipo de operación']);
        }

        return view('agenda-crear-desde-consulta', compact('operacion','marcas','sedes_entrega','tipos_operacion','accesorios','marcax', 'tipo_operacionx'));

    }
}
