@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible">
            {{ Session::get('mensaje') }}
        </div>
        @endif

        <a class="btn btn-success" href="{{ url('/departamentos/create') }}">Crear Departamentos</a>
        <table class="table table-ligth">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Fecha Creación</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $datos)
                    <tr>
                        <td>{{ $datos->id }}</td>
                        <td>{{ $datos->Nombre }}</td>
                        <td>{{ $datos->FechaCreacion }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ url('/departamentos/' . $datos->id . '/edit') }}">Editar</a> |
                            <form action="{{ url('/departamentos/' . $datos->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea Eliminar?')" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!!$departamentos->Links()!!}
    </div>
@endsection
