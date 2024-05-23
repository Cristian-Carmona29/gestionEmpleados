@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Perfil</h1>

        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="show-password-btn">
                            <i class="fa fa-eye" id="show-password-icon"></i>
                        </button>
                    </div>
                </div>
                <small class="form-text text-muted">Dejar en blanco si no deseas cambiar la contraseña.</small>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a class="btn btn-danger" href="{{url('/empleados')}}">Cancelar</a>
        </form>
    </div>

    <script>
        // Mostrar u ocultar la contraseña cuando se hace clic en el botón
        document.getElementById("show-password-btn").addEventListener("click", function() {
            var passwordField = document.getElementById("password");
            var passwordIcon = document.getElementById("show-password-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            }
        });
    </script>
@endsection
