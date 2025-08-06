@extends('layouts.app')

@section('content')
    <h2>Crear empleado</h2>

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

    <form id="empleadoForm" action="{{ route('empleados.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3 row">
            <label for="nombre" class="col-md-3 col-form-label"><strong>Nombre completo *</strong></label>
            <div class="col-md-9">
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required placeholder="Nombre completo del empleado">
                <div class="invalid-feedback">El nombre es obligatorio y debe tener al menos 3 caracteres.</div>
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-3 row">
            <label for="email" class="col-md-3 col-form-label"><strong>Correo electrónico *</strong></label>
            <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="Correo electrónico">
                <div class="invalid-feedback">Este campo es obligatorio y debe ingresar un correo válido.</div>
            </div>
        </div>

        {{-- Sexo --}}
        <div class="mb-3 row">
            <label class="col-md-3 col-form-label"><strong>Sexo *</strong></label>
            <div class="col-md-9 d-flex align-items-center gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" {{ old('sexo') == 'M' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoM">Masculino</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" {{ old('sexo') == 'F' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoF">Femenino</label>
                </div>

                <div class="invalid-feedback" id="sexoError" style="display: none;">
                    Debe seleccionar una opción.
                </div>
            </div>
        </div>

        {{-- Área --}}
        <div class="mb-3 row">
            <label for="area_id" class="col-md-3 col-form-label"><strong>Área *</strong></label>
            <div class="col-md-9">
                <select name="area_id" id="area_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>
        </div>

        {{-- Descripción --}}
        <div class="mb-3 row">
            <label for="descripcion" class="col-md-3 col-form-label"><strong>Descripción *</strong></label>
            <div class="col-md-9">
                <textarea name="descripcion" id="descripcion" class="form-control" required placeholder="Descripción de la experiencia del empleado">{{ old('descripcion') }}</textarea>
                <div class="invalid-feedback">Este campo es obligatorio y debe tener al menos 10 caracteres.</div>
            </div>
        </div>

        {{-- Boletín --}}
        <div class="mb-3 row">
            <div class="col-md-9 offset-md-3">
                <div class="form-check">
                    <input type="checkbox" name="boletin" id="boletin" class="form-check-input" value="1" {{ old('boletin') ? 'checked' : '' }}>
                    <label for="boletin" class="form-check-label"><strong>Deseo recibir boletín informativo</strong></label>
                </div>
            </div>
        </div>

        {{-- Roles --}}
        <div class="mb-3 row roles-wrapper">
            <label class="col-md-3 col-form-label"><strong>Roles *</strong></label>
            <div class="col-md-9">
                @foreach ($roles as $rol)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="rol_{{ $rol->id }}" class="form-check-input"
                               value="{{ $rol->id }}" {{ is_array(old('roles')) && in_array($rol->id, old('roles')) ? 'checked' : '' }}>
                        <label for="rol_{{ $rol->id }}" class="form-check-label">{{ $rol->nombre }}</label>
                    </div>
                @endforeach
                <div class="invalid-feedback" style="display: none;">Debe seleccionar al menos un rol.</div>
            </div>
        </div>

        {{-- Botón --}}
        <div class="row mb-3">
            <div class="col-md-9 offset-md-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
@endsection