<h1>{{ $modo }} Departamento</h1>
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<input class="form-control" type="text" value="{{ isset($departamentos->Nombre) ? $departamentos->Nombre :old('Nombre') }}" name="Nombre" id="Nombre" placeholder="Introduce Nombre"><br>
<input class="form-control" type="date" value="{{ isset($departamentos->FechaCreacion) ? $departamentos->FechaCreacion :old('FechaCreacion') }}" name="FechaCreacion" id="FechaCreacion"><br>
<input class="btn btn-warning" type="submit" value="{{ $modo }} Registro">
