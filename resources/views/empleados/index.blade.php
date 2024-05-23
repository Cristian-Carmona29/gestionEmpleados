@extends('layouts.app')
@section('content')
    <div class="container">
        <form id="search-form" class="form-inline mb-2">
            <input type="text" id="search-input" name="query" class="form-control mr-sm-2" placeholder="Buscar..."><br>
            <button type="submit" id="search-button" class="btn btn-outline-primary my-2 my-sm-0">Buscar</button>
        </form>

        <div id="search-results"></div>

        {{-- Recibir función mensaje --}}
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
            </div>
        @endif
        <a href="{{ url('/empleados/create') }}" class="btn btn-success">Registrar Empleado</a>
        <table class="table table-ligth">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody id="empleados-table-body">
                @foreach ($empleados as $datos)
                    <tr>
                        <td>{{ $datos->id }}</td>
                        <td><img src="{{ asset('storage') . '/' . $datos->Foto }}" alt="" width="200"
                                height="200"></td>
                        <td>{{ $datos->Nombre }}</td>
                        <td>{{ $datos->Apellido }}</td>
                        <td>{{ $datos->Correo }}</td>
                        <td>{{ $datos->Telefono }}</td>
                        <td>
                            <a href="{{ url('/empleados/' . $datos->id . '/edit') }}" class="btn btn-warning">Editar</a> |
                            <form action="{{ url('/empleados/' . $datos->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" onclick="return confirm('¿Deseas Eliminar?')" value="Eliminar"
                                    class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    @if ($datos->departamento_id)
                        <tr>
                            <td colspan="6">Departamento: {{ $datos->departamento->Nombre }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6">Sin departamento asociado</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>
        {!! $empleados->Links() !!}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#search-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ url('/empleados/buscar') }}",
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('#empleados-table-body').html(response);
                    }
                });
            });
        });
    </script>
@endpush
