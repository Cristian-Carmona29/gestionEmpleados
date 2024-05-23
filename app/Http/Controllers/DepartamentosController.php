<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listado['departamentos'] = departamentos::paginate(4);

        return view('departamentos.index', $listado);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación Datos
        $validacion = [
            'Nombre'=>'required|string|max:100',
            'FechaCreacion'=>'required|date'
        ];
        $msj = [
            'required'=>'El :attribute es requerido',
        ];
        $this-> validate($request, $validacion, $msj);
        //$datosDepartamentos = request()->all();
        $datosDepartamentos = request()->except('_token');
        departamentos::insert($datosDepartamentos);
        return redirect('departamentos')->with('mensaje','Registro Exitoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(departamentos $departamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $departamentos = departamentos::findOrFail($id);
        return view('departamentos.update', compact('departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Validación Datos
        $validacion = [
            'Nombre'=>'required|string|max:100',
            'FechaCreacion'=>'required|date'
        ];
        $msj=['required'=>'El :attribute es requerido'];
        $this-> validate($request, $validacion, $msj);
        $datos = request()->except(['_token','_method']);
        departamentos::where('id','=',$id)->update($datos);

        return redirect('departamentos')->with('mensaje','Edición Exitosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        departamentos::destroy($id);
        return redirect('departamentos')->with('mensaje','Registro Eliminado');

    }
}
