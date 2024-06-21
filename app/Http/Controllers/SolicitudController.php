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

            $solicitudesAprobadas = solicitud::where('estado', 'aprobado')->get();
            $solicitudesPendientes = solicitud::where('estado', 'pendiente')->get();
            $solicitudesProvisionales = solicitud::where('estado', 'provisional')->orWhere('estado', 'pagado')->get();
            $solicitudesRechazadas = solicitud::where('estado', 'rechazado')->get();

            return view('funcionario.solicitudes.index', [
                'solicitudesAprobadas' => $solicitudesAprobadas,
                'solicitudesPendientes' => $solicitudesPendientes,
                'solicitudesProvisionales' => $solicitudesProvisionales,
                'solicitudesRechazadas' => $solicitudesRechazadas,
            ]);
        } else if (auth()->user()->perfil->tipo == 'dat') {
            $solProvisionales = solicitud::where('estado', 'provisional')->get();
            $solSinTributo = $solProvisionales->filter(fn ($solicitud) => $solicitud->tributo == null);
            $solConTributo = $solProvisionales->filter(fn ($solicitud) => $solicitud->tributo != null);
            $solDefinitivas = solicitud::where('estado', 'aprobado')->get();

            return view('dat.solicitudes.index', [
                'solicitudesSinTributo' => $solSinTributo,
                'solicitudesConTributo' => $solConTributo,
                'solicitudesAprobadas' => $solDefinitivas,
            ]);


        } else {

            $perfil = auth()->user()->perfil;

            $solicitudesPendientes = solicitud::where('perfil_id', $perfil->id)->where('estado', 'pendiente')->get();
            $solicitudesProvisionales = solicitud::where('perfil_id', $perfil->id)->where('estado', 'provisional')->get();
            $solicitudesAprobadas = solicitud::where('perfil_id', $perfil->id)->where('estado', 'aprobado')->get();
            $solicitudesRechazadas = solicitud::where('perfil_id', $perfil->id)->where('estado', 'rechazado')->get();


            return view('solicitante.solicitudes.index', [
                'solicitudesAprobadas' => $solicitudesAprobadas,
                'solicitudesPendientes' => $solicitudesPendientes,
                'solicitudesProvisionales' => $solicitudesProvisionales,
                'solicitudesRechazadas' => $solicitudesRechazadas,
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
        return view('solicitante.solicitudes.create');
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
        } else if (auth()->user()->perfil->tipo == 'dat') {
            return view('dat.solicitudes.show', ['solicitud' => $solicitud]);
        } else {
            return view('solicitante.solicitudes.show', ['solicitud' => $solicitud]);
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
            if ($solicitud->estado == 'provisional') {
                return response('La solicitud ya se encuentra aprobada provisionalmente', 400);
            }

            $solicitud->estado = 'provisional';
            $solicitud->fecha_permisoprovisional = now();
            $solicitud->permiso_provisional = 'permiso_prov/permiso_provisional.pdf';
            $solicitud->save();
            return response('Solicitud provional aprobada', 200);
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

            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->perfil->tipo == 'dat' || $user->id == solicitud::where('url_rif', 'rif/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/rif/' . $file));
        }

        if ($request->is('permiso/*')) {
            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->perfil->tipo == 'dat' || $user->id == solicitud::where('url_permiso', 'permiso/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/permiso/' . $file));
        }

        if ($request->is('permiso_prov/*')) {
            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->perfil->tipo == 'dat' || $user->id == solicitud::where('permiso_provisional', 'permiso_prov/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/permiso_prov/' . $file));
        }

        if ($request->is('permiso_def/*')) {
            Gate::allowIf(fn(User $user) => $user->perfil->tipo == 'funcionario' || $user->perfil->tipo == 'dat' || $user->id == solicitud::where('permiso_definitivo', 'permiso_def/' . $file)->first()->perfil->user_id);

            return response()->file(storage_path('app/permiso_def/' . $file));
        }

        abort(403, 'Usuario no autorizado para ver archivo');
    }

    public function rechazar(Request $request, solicitud $solicitud)
    {
        if ($request->user()->perfil->tipo != 'funcionario') {
            abort(403, 'No tiene autoridad para rechazar solicitudes.');
        }

        $solicitud->estado = 'rechazado';
        $solicitud->razon_rechazo = $request->input('razon_rechazo');
        $solicitud->save();

        return response('OK', 200);
    }

    public function aprobarPermisoDefinitivo(Request $request, solicitud $solicitud)
    {
        if (Gate::allows('aprobar-permiso-definitivo', $solicitud)) {

            if ($solicitud->estado == 'aprobado') {
                return response('La solicitud ya se encuentra aprobada', 400);
            }

            if ($solicitud->estado != 'pagado') {
                return response('La solicitud debe ser pagada antes', 400);
            }

            $solicitud->estado = 'aprobado';
            $solicitud->fecha_permisodefinitivo = now();
            $solicitud->permiso_definitivo = 'permiso_def/permiso_definitivo.pdf';
            $solicitud->save();
            return response('Permiso definitivo aprobado', 200);
        }
        abort(403, 'No posee autoridad para aprobar el permiso');
    }
}
