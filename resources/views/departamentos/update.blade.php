@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-info" href="{{url('/departamentos')}}">Listar Departamentos</a><br>
        <form action="{{ url('/departamentos/' . $departamentos->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            @include('departamentos.form', ['modo' => 'Actualizar'])
        </form>
    </div>
@endsection
