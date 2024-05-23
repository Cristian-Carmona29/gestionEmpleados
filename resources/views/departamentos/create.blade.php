@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-info" href="{{url('/departamentos')}}">Listar Empleados</a>
        <form action="{{url('/departamentos')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('departamentos.form',['modo'=>'Crear'])
        </form>
    </div>
@endsection