@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Perfil de Usuario</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Detalles del Perfil
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
            </div>
        </div>
    </div>
@endsection
