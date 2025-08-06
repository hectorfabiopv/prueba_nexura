@extends('layouts.app')

@section('content')
    <h2>Empleados registrados</h2>

    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">+ Nuevo Empleado</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($empleados->count() > 0)
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Sexo</th>
                    <th>Área</th>
                    <th>Boletín</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->sexo }}</td>
                        <td>{{ $empleado->area->nombre }}</td>
                        <td>{{ $empleado->boletin ? 'Sí' : 'No' }}</td>
                        <td>
                            @foreach($empleado->roles as $rol)
                                <span class="badge bg-secondary">{{ $rol->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Aún no hay empleados registrados.</p>
    @endif
@endsection