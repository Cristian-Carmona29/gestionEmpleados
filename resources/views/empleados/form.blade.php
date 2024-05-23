<div class="form-group">
    <h1>{{ $modo }} Empleado</h1><br>
    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <input class="form-control" type="text" value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre') }}" name="Nombre" id="Nombre" placeholder="Introduzca Nombre"><br>
    <input class="form-control" type="text" value="{{ isset($empleado->Apellido) ? $empleado->Apellido : old('Apellido') }}" name="Apellido" id="Apellido" placeholder="Introduzca Apellido"><br>
    <input class="form-control" type="email" value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo') }}" name="Correo" id="Correo" placeholder="Introduzca Correo"><br>
    <input class="form-control" type="text" value="{{ isset($empleado->Telefono) ? $empleado->Telefono : old('Telefono') }}" name="Telefono" id="Telefono" placeholder="Introduzca Teléfono"><br>
    <input class="form-control" type="file" name="Foto" id="Foto"><br>
    @if (isset($empleado->Foto))
        <img src="{{ asset('storage') . '/' . $empleado->Foto }}" alt="" width="220" height="220"><br>
    @endif
    <br>
    {{-- Agregar campo de selección de departamento --}}
    <label for="departamento_id">Departamento:</label>
    <select class="form-control" name="departamento_id" id="departamento_id">
        <option value="" disabled selected>Seleccione Departamento</option>
        @foreach($departamentos as $departamento)
            <option value="{{ $departamento->id }}" {{ isset($empleado) && $empleado->departamento_id == $departamento->id ? 'selected' : '' }}>{{ $departamento->Nombre }}</option>
        @endforeach
    </select><br>
    
    <input type="submit" value="{{ $modo }} Registro" class="btn btn-warning">
</div>
