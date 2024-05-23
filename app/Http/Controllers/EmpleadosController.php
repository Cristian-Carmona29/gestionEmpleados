<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use App\Models\departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{

    public function index(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $query = $request->input('query');

        // Construir la consulta para obtener todos los empleados
        $empleados = empleados::query();

        // Si hay un término de búsqueda, aplicar el filtro
        if (!empty($query)) {
            $empleados->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('Nombre', 'LIKE', "%$query%")
                    ->orWhere('Apellido', 'LIKE', "%$query%")
                    ->orWhere('Correo', 'LIKE', "%$query%")
                    ->orWhere('Telefono', 'LIKE', "%$query%");
            });
        }

        // Paginar los resultados
        $empleados = $empleados->paginate(3);

        // Obtener todos los departamentos
        $departamentos = departamentos::all();

        // Pasar los resultados de búsqueda y los departamentos a la vista
        return view('empleados.index', compact('empleados', 'query', 'departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los departamentos
        $departamentos = departamentos::all();

        // Pasar los departamentos a la vista de creación
        return view('empleados.create', compact('departamentos'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación Campos
        $validacion = [
            'Nombre' => 'required|string|max:90',
            'Apellido' => 'required|string|max:90',
            'Correo' => 'required|string|max:90',
            'Correo' => 'required|string|max:90',
            'Telefono' => 'required|string|max:90',
            'Foto' => 'required'
        ];
        $msj = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La Foto es requerida'
        ];
        $this->validate($request, $validacion, $msj);
        //Obtener datos menos token
        $datosEmpleados = request()->except('_token');
        //Verificar archivo de foto
        if ($request->hasFile('Foto')) {
            //almacenar el archivo en uploads de public
            $datosEmpleados['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        //insertar lo datos
        empleados::insert($datosEmpleados);
        //return response()->json($datosEmpleados);
        //retornar mensaje
        return redirect('empleados')->with('mensaje', 'Registro Exitoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar el empleado por su id
        $empleado = empleados::findOrFail($id);

        // Obtener todos los departamentos
        $departamentos = departamentos::all();

        // Pasar el empleado y los departamentos a la vista
        return view('empleados.update', compact('empleado', 'departamentos'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de Campos
        $validacion = [
            'Nombre' => 'required|string|max:90',
            'Apellido' => 'required|string|max:90',
            'Correo' => 'required|string|max:90|email',
            'Telefono' => 'required|string|max:90',
        ];

        $msj = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La Foto es requerida',
        ];

        // Agregar validación de la foto si está presente
        if ($request->hasFile('Foto')) {
            $validacion['Foto'] = 'required|max:10000|mimes:jpg,png,jpeg';
        }

        $this->validate($request, $validacion, $msj);

        // Obtener los datos del formulario, excepto _token y _method
        $datos = $request->except(['_token', '_method']);

        // Verificar si se ha subido una foto y almacenarla
        if ($request->hasFile('Foto')) {
            $datos['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        // Actualizar los datos en la base de datos
        empleados::where('id', '=', $id)->update($datos);

        // Redirigir a la ruta de empleados con un mensaje de éxito
        return redirect('empleados')->with('mensaje', 'Registro Actualizado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //buscar imagen para borrarla
        $empleados = empleados::findOrFail($id);
        if (Storage::delete('public/' . $empleados->Foto)) {
            empleados::destroy($id);
        }

        return redirect('empleados')->with('mensaje', 'Registro Eliminado');
    }
}
