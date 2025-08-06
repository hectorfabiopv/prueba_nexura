<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with(['area', 'roles'])->get();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $roles = Rol::all();

        return view('empleados.create', compact('areas', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules());

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        $areas = Area::all();
        $roles = Rol::all();
        $empleado->load('roles');

        return view('empleados.edit', compact('empleado', 'areas', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate($this->rules($empleado));

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->roles()->detach();
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }

    /**
     * Get validation rules.
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
}