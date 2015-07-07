@extends('template.app')
@section('page', $page_title)
@section('padre', 'Administracion')
@section('content')
<table class="table table-bordered">
        <thead>
            <tr class="success">
                <th colspan="3" class="text-center"><i class="fa fa-users"></i> Usuarios Registrados</th>
            </tr>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Operación</th>
            </tr>
        </thead>
        <tbody>
           @foreach($users as $user)
            <tr class="text-center">
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection