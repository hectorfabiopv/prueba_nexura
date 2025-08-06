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

    <div class="alert alert-info">
        <strong>Los campos con asteriscos (*) son obligatorios.</strong>
    </div>

    <form id="empleadoForm" action="{{ route('empleados.update', $empleado) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3 row">
            <label for="nombre" class="col-md-3 col-form-label">Nombre completo *</label>
            <div class="col-md-9">
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}"  placeholder="Nombre completo del empleado">
                <div class="invalid-feedback">El nombre es obligatorio y debe tener al menos 3 caracteres.</div>
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-3 row">
            <label for="email" class="col-md-3 col-form-label">Correo electrónico *</label>
            <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $empleado->email) }}"  placeholder="Correo electrónico">
                <div class="invalid-feedback">Este campo es obligatorio y debe ingresar un correo válido.</div>
            </div>
        </div>

        {{-- Sexo --}}
        <div class="mb-3 row">
            <label class="col-md-3 col-form-label">Sexo *</label>
            <div class="col-md-9 d-flex align-items-center gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" {{ old('sexo', $empleado->sexo) == 'M' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoM">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" {{ old('sexo', $empleado->sexo) == 'F' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoF">Femenino</label>
                </div>
                <div class="invalid-feedback" id="sexoError" style="display: none;">
                    Debe seleccionar una opción.
                </div>
            </div>
        </div>

        {{-- Área --}}
        <div class="mb-3 row">
            <label for="area_id" class="col-md-3 col-form-label">Área *</label>
            <div class="col-md-9">
                <select name="area_id" id="area_id" class="form-select" >
                    <option value="">Seleccione...</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id', $empleado->area_id) == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>
        </div>

        {{-- Descripción --}}
        <div class="mb-3 row">
            <label for="descripcion" class="col-md-3 col-form-label">Descripción *</label>
            <div class="col-md-9">
                <textarea name="descripcion" id="descripcion" class="form-control"  placeholder="Descripción de la experiencia del empleado">{{ old('descripcion', $empleado->descripcion) }}</textarea>
                <div class="invalid-feedback">Este campo es obligatorio y debe tener al menos 10 caracteres.</div>
            </div>
        </div>

        {{-- Boletín --}}
        <div class="mb-3 row">
            <div class="col-md-9 offset-md-3">
                <div class="form-check">
                    <input type="checkbox" name="boletin" id="boletin" class="form-check-input" value="1" {{ old('boletin', $empleado->boletin) ? 'checked' : '' }}>
                    <label for="boletin" class="form-check-label">Desea recibir boletín informativo</label>
                </div>
            </div>
        </div>

        {{-- Roles --}}
        <div class="mb-3 row roles-wrapper">
            <label class="col-md-3 col-form-label">Roles *</label>
            <div class="col-md-9">
                @foreach ($roles as $rol)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="rol_{{ $rol->id }}" class="form-check-input"
                               value="{{ $rol->id }}"
                               {{ in_array($rol->id, old('roles', $empleado->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label for="rol_{{ $rol->id }}" class="form-check-label">{{ $rol->nombre }}</label>
                    </div>
                @endforeach
                <div class="invalid-feedback" style="display: none;">Debe seleccionar al menos un rol.</div>
            </div>
        </div>

        {{-- Botón --}}
        <div class="row mb-3">
            <div class="col-md-9 offset-md-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
@endsection