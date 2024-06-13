<?php

namespace App\Http\Controllers;

use App\Models\solicitud;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
            $sol = auth()->user()->perfil->solicitudes;

            $solicitudesPendientes = $sol->filter(function ($item) {
                return $item->aprobado == false;
            });
            $solicitudesAprobadas = $sol->filter(function ($item) {
                return $item->aprobado == true;
            });
            return view('solicitudes.index', [
                'solicitudesAprobadas' => $solicitudesAprobadas,
                'solicitudesPendientes' => $solicitudesPendientes,
            ]);
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
        $rif = $request->file('rif_productora');
        $permiso = $request->file('permiso');

        if (!$rif->isValid()) {
            abort(500, 'Error al subir el archivo RIF. Intente nuevamente.');
        }

        if (!$permiso->isValid()) {
            abort(500, 'Error al subir el archivo Permiso. Intente nuevamente.');
        }

        $solicitud = solicitud::create([
            'perfil_id' => $request->user()->perfil->id,
            'nombre_evento' => $request->nombre_evento,
            'descripcion' => $request->descripcion,
            'fecha_inspeccion' => $request->fecha_inspeccion,
            'fecha_solicitud' => $request->fecha_solicitud,
            'url_rif' => $rif->store('rif'),
            'url_permiso' => $permiso->store('permiso'),
            'numero_entradas' => $request->numero_entradas,
            'numero_funciones' => $request->numero_funciones,
        ]);

        return redirect(route('solicitudes.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(solicitud $solicitud)
    {
        if (auth()->user()->perfil->tipo == 'funcionario') {
            return view('funcionario.solicitudes.show', ['solicitud' => $solicitud]);
        } else {
            return view('solicitudes.show', ['solicitud' => $solicitud]);
        }
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

    public function aprobar(Request $request, solicitud $solicitud)
    {

        if (Gate::allows('aprobar-solicitud', $solicitud)) {
            if ($solicitud->aprobado) {
                return response('La solicitud ya se encuentra aprobada', 400);
            }

            $solicitud->aprobado = true;
            $solicitud->fecha_permisoprovisional = now();
            $solicitud->save();
            return response('Solicitud aprobada', 200);
        }

        abort(403, 'No posee autoridad para aprobar la solicitud');
    }

    public function asignarNumero(Request $request, solicitud $solicitud) {
//        return response('');
        if (Gate::allows('asignar-numero', $solicitud)) {

            $numero = $request->input('numero');
            $solicitud->N_solicitud = $numero;
            $solicitud->save();
            return response($numero, 200);
        }
        abort(403, 'No posee autoridad para asignar numero a la solicitud');
    }

    public function getFile(Request $request, string $file)
    {
        if ($request->is('rif/*')) {

            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->id == solicitud::where('url_rif', 'rif/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/rif/' . $file));
        }

        if ($request->is('permiso/*')) {
            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->id == solicitud::where('url_permiso', 'permiso/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/permiso/' . $file));
        }

        abort(403, 'Usuario no autorizado para ver archivo');
    }
}
