<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Operacion_PA_CG;
use App\Marca;
use App\TipoOperacion;
use App\SedeEntrega;
use App\Accesorio;

class Operaciones_PA_Controller extends Controller
{
    //

    public function index(Request $request){

        $marcas = Marca::where('activo','=',1)->orderBy('nombre')->get();
        $sedes_entrega = SedeEntrega::where('activo','=',1)->orderBy('nombre')->get();
        $tipos_operacion = (new TipoOperacion)->get_tipos();
        $accesorios = Accesorio::where('activo','=',1)->orderBy('nombre')->get();

        $marcax = $request->marca_id;
        $tipo_operacionx = $request->tipo_operacion;

    	switch ($request->marca_id) {
    		case 1: //FIAT
    			if ($request->tipo_operacion == 1) { //PLAN DE AHORRO

    				$operacion = DB::connection('mysql_cg')->select("SELECT operaciones.Grupo, operaciones.Orden, 0 AS NroPreventa, operaciones.Apellido, operaciones.Nombres, operaciones.Telefonos AS Telefonos1, operaciones.Telefonos2, operaciones.Telefonos3, operaciones.eMail AS Email, modelos.Nombre AS Modelo
						FROM operaciones
						LEFT JOIN modelos ON operaciones.Marca = modelos.Marca AND operaciones.ModeloPedido = modelos.Codigo
						WHERE operaciones.Grupo = '$request->grupo' AND operaciones.Orden = $request->orden;");
    				
    			}
    			elseif ($request->tipo_operacion == 2) { //CONVENCIONAL
                    
                    $pdo = DB::connection('sqlsrv_cg')->getPdo();
                    $stmt = $pdo->query("EXEC dbo.U0_BUnidadConAccesoriosXOperacVta $request->nro_preventa");
                    $operacion = $stmt->fetchAll();


    				//$operacion = DB::connection('sqlsrv_cg')->select("EXEC dbo.U0_BUnidadConAccesoriosXOperacVta $request->nro_preventa"); 				
    			}
    			break;

    		case 2: //JEEP
    			if ($request->tipo_operacion == 1) { //PLAN DE AHORRO

                    $operacion = DB::connection('mysql_det')->select("SELECT operaciones.Grupo, operaciones.Orden, 0 AS NroPreventa, operaciones.Apellido, operaciones.Nombres, operaciones.Telefonos AS Telefonos1, operaciones.Telefonos2, operaciones.Telefonos3, operaciones.eMail AS Email, modelos.Nombre AS Modelo
                        FROM operaciones
                        LEFT JOIN modelos ON operaciones.Marca = modelos.Marca AND operaciones.ModeloPedido = modelos.Codigo
                        WHERE operaciones.Grupo = '$request->grupo' AND operaciones.Orden = $request->orden;");

    			}
    			elseif ($request->tipo_operacion == 2) { //CONVENCIONAL
    				$ret = 'jeep Convencional';
    			}
    			break;
    	}

        if ($operacion != null) {
            $operacion = $operacion[0];

            return view('agenda-crear-desde-consulta', compact('operacion','marcas','sedes_entrega','tipos_operacion','accesorios','marcax', 'tipo_operacionx'));
        }
        else{
            return redirect()->back()->withErrors(['No se encontro la operación']);
        }


    }
}
