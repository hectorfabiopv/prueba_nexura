<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with(['area', 'roles'])->get();
        return response()->json($empleados);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id'          => 'required|integer|unique:empleados,id',
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'required|string',
            'sexo'        => 'required|in:M,F,O',
            'area_id'     => 'required|exists:areas,id',
            'boletin'     => 'nullable|boolean',
            'roles'       => 'required|array',
            'roles.*'     => 'exists:roles,id',
        ]);

        $empleado = Empleado::create($validated);
        $empleado->roles()->sync($request->roles);

        return response()->json(['message' => 'Empleado creado correctamente'], 201);
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
        //
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
