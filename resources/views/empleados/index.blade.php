@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de empleados</h2>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Crear
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($empleados->count() > 0)
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th><i class="bi bi-person-fill"></i> Nombre</th>
                    <th><i class="bi bi-at"></i> Email</th>
                    <th><i class="bi bi-gender-ambiguous"></i> Sexo</th>
                    <th><i class="bi bi-briefcase-fill"></i> Área</th>
                    <th><i class="bi bi-envelope-fill"></i> Boletín</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->sexo === 'M' ? 'Masculino' : 'Femenino' }}</td>
                        <td>{{ $empleado->area->nombre }}</td>
                        <td>{{ $empleado->boletin ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </button>
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