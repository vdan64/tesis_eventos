<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->perfil->tipo == 'funcionario') {
            $solicitudesAprobadas = solicitud::where('aprobado', true)->get();
            $solicitudesPendientes = solicitud::where('aprobado', false)->get();
            return view('funcionario.solicitudes.index', [
                'solicitudesAprobadas' => $solicitudesAprobadas,
                'solicitudesPendientes' => $solicitudesPendientes,
            ]);
        } else {
            return view('solicitudes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->user()->perfil->tipo == 'funcionario') {
            return redirect(route('funcionario.dashboard', absolute: false));
        }
        return view('solicitudes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $solicitud = solicitud::create([
            'perfil_id' => $request->user()->perfil->id,
            'nombre_evento' => $request->nombre_evento,
            'descripcion' => $request->descripcion,
            'fecha_inspeccion' => $request->fecha_inspeccion,
            'fecha_solicitud' => $request->fecha_solicitud,
        ]);


        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(solicitud $solicitud)
    {
        return view('solicitudes.show', ['solicitud' => $solicitud]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function aprobar(solicitud $solicitud) {

    }
}
