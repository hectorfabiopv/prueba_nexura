<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'email' => 'required|email|unique:empleados,email',
            'sexo'        => 'required|in:M,F,O',
            'area_id'     => 'required|exists:areas,id',
            'boletin'     => 'nullable|boolean',
            'descripcion' => 'required|string',
            'roles'       => 'required|array',
            'roles.*'     => 'exists:roles,id',
        ]);

        $empleado = Empleado::create($validated);
        $empleado->roles()->sync($request->roles);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return response()->json($empleado);
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

        $validated = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'required|string',
            'sexo'        => 'required|in:M,F,O',
            'area_id'     => 'required|exists:areas,id',
            'boletin'     => 'nullable|boolean',
            'roles'       => 'required|array',
            'roles.*'     => 'exists:roles,id',
        ]);

        $empleado->update($validated);
        $empleado->roles()->sync($request->roles);

        return response()->json(['message' => 'Empleado actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->roles()->detach();
        $empleado->delete();

        return response()->json(['message' => 'Empleado eliminado correctamente']);
    }
}
