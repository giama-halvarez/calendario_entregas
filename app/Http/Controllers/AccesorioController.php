<?php

namespace App\Http\Controllers;

use App\Accesorio;
use Illuminate\Http\Request;

class AccesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->rol >= 9){
            $accesorios = Accesorio::where('activo','=',1)->orderBy('nombre')->get();

            return view('accesorios', compact('accesorios'));            
        }
        else{
            return redirect('/agenda/ver/pendientes');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validacion = $request->validate([
            'nombre' => 'required',
        ]);

        Accesorio::create($validacion);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function show(Accesorio $accesorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Accesorio $accesorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accesorio $accesorio)
    {
        //
        $validacion = $request->validate([
            'nombre' => 'required',
        ]);

        $accesorio->update($validacion);

        return redirect(route('accesorios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accesorio  $accesorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accesorio $accesorio)
    {
        //
        $accesorio->update(['activo' => 0]);

        return redirect(route('accesorios.index'));
    }
}
