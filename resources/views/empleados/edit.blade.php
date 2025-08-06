@extends('layouts.app')

@section('content')
    <h2>Editar empleado</h2>

    <a href="{{ route('empleados.index') }}" class="btn btn-secondary mb-3">← Volver al listado</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $empleado->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" id="sexo" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="M" {{ old('sexo', $empleado->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ old('sexo', $empleado->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                <option value="O" {{ old('sexo', $empleado->sexo) == 'O' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="area_id" class="form-label">Área</label>
            <select name="area_id" id="area_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area_id', $empleado->area_id) == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $empleado->descripcion) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="boletin" id="boletin" class="form-check-input" value="1"
                {{ old('boletin', $empleado->boletin) ? 'checked' : '' }}>
            <label for="boletin" class="form-check-label">Desea recibir boletín informativo</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Roles</label>
            @foreach ($roles as $rol)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" id="rol_{{ $rol->id }}" class="form-check-input"
                        value="{{ $rol->id }}"
                        {{ in_array($rol->id, old('roles', $empleado->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="rol_{{ $rol->id }}" class="form-check-label">{{ $rol->nombre }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
@endsection