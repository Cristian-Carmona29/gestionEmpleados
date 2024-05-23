@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/empleados/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('empleados.form', ['modo' => 'Actualizar', 'empleado' => $empleado, 'departamentos' => $departamentos])
        </form>
    </div>
@endsection
