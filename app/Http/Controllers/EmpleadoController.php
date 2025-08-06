<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with(['area', 'roles'])->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $areas = Area::all();
        $roles = Rol::all();

        return view('empleados.create', compact('areas', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $empleado = Empleado::create([
            'nombre'      => $validated['nombre'],
            'email'       => $validated['email'],
            'sexo'        => $validated['sexo'],
            'area_id'     => $validated['area_id'],
            'descripcion' => $validated['descripcion'],
            'boletin'     => $request->has('boletin'),
        ]);

        $empleado->roles()->sync($validated['roles']);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        $areas = Area::all();
        $roles = Rol::all();
        $empleado->load('roles');

        return view('empleados.edit', compact('empleado', 'areas', 'roles'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validator = Validator::make($request->all(), $this->rules($empleado), $this->messages());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $empleado->update([
            'nombre'      => $validated['nombre'],
            'email'       => $validated['email'],
            'sexo'        => $validated['sexo'],
            'area_id'     => $validated['area_id'],
            'descripcion' => $validated['descripcion'],
            'boletin'     => $request->has('boletin'),
        ]);

        $empleado->roles()->sync($validated['roles']);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->roles()->detach();
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }

    /**
     * Reglas de validación.
     */
    private function rules(Empleado $empleado = null): array
    {
        $id = $empleado?->id ?? 'NULL';

        return [
            'nombre'      => 'required|string|max:100',
            'email'       => "required|email|unique:empleados,email,$id",
            'sexo'        => 'required|in:M,F',
            'area_id'     => 'required|exists:areas,id',
            'boletin'     => 'nullable|boolean',
            'descripcion' => 'required|string|min:10|max:1000',
            'roles'       => 'required|array|min:1',
            'roles.*'     => 'exists:roles,id',
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    private function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe superar los 100 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'sexo.required' => 'Debe seleccionar el sexo.',
            'sexo.in' => 'Sexo inválido. Debe ser Masculino o Femenino.',
            'area_id.required' => 'Debe seleccionar un área.',
            'area_id.exists' => 'El área seleccionada no es válida.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no debe superar los 1000 caracteres.',
            'boletin.boolean' => 'Valor inválido para boletín.',
            'roles.required' => 'Debe seleccionar al menos un rol.',
            'roles.array' => 'El campo de roles debe ser una lista.',
            'roles.*.exists' => 'Uno de los roles seleccionados no es válido.',
        ];
    }
}