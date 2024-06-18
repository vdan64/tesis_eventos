<?php

namespace App\Http\Controllers;

use App\Models\solicitud;
use App\Models\tributo;
use Illuminate\Http\Request;

class TributoController extends Controller
{
    public function index()
    {
        if (auth()->user()->perfil->tipo == 'funcionario') {
            abort(403, 'No tiene autoridad');
        } else if (auth()->user()->perfil->tipo == 'dat') {
            $tributosPendientes = tributo::where('idpago', null)->get();
            $tributosReportados = tributo::where('idpago', '!=', null)->where('confirmado', false)->get();
            $tributosConfirmados = tributo::where('confirmado', true)->get();

            return view('dat.tributos.index', [
                'tributosPendientes' => $tributosPendientes,
                'tributosReportados' => $tributosReportados,
                'tributosConfirmados' => $tributosConfirmados,
            ]);
        } else {
            $solicitudes = auth()->user()->perfil->solicitudes;

            $tributos = $solicitudes->map(fn($solicitud) => $solicitud->tributo);

            $tributosPendientes = $tributos->map(fn($tributo) => $tributo->idpago == null);
            $tributosReportados = $tributos->map(fn($tributo) => $tributo->idpago != null);

            return view('tributos.index', [
                'tributosPendientes' => $tributosPendientes,
                'tributosReportados' => $tributosReportados,
            ]);
        }
    }

    public function show(Request $request, tributo $tributo)
    {
        if ($request->user()->perfil->tipo == 'dat') {
            return view('dat.tributos.show', [
                'tributo' => $tributo,
            ]);
        } elseif ($request->user()->perfil->tipo == 'funcionario') {
            abort(403, 'No tiene autoridad');
        } else {

            return view('tributos.show', [
                'tributo' => $tributo,
            ]);
        }
    }

    public function create(Request $request, solicitud $solicitud)
    {
        if ($request->user()->perfil->tipo != 'dat') {
            abort(403, 'No tiene autoridad para crear tributos');
        }
        return view('dat.tributos.create');
    }

    public function store(Request $request, solicitud $solicitud)
    {
        if (auth()->user()->perfil->tipo == 'dat') {
            $solicitud->tributo()->create([
                'descripcion' => $request->input('descripcion'),
                'tipo' => 0,
                'monto' => $request->input('monto'),
            ]);

            return to_route('dat.dashboard');
        }
        abort(403, 'No tiene autoridad');
    }

    public function reportar(Request $request, tributo $tributo)
    {
        if ($request->user()->perfil->tipo != 'solicitante') {
            return abort(403, 'No tiene autoridad');
        }

        $fechapago = $request->input('fechapago');
        $cuenta_destino = $request->input('cuenta_destino');
        $idpago = $request->input('idpago');

        $tributo->idpago = $idpago;
        $tributo->fechapago = $fechapago;
        $tributo->cuenta_destino = $cuenta_destino;
        $tributo->save();

        return response('OK', 200);
    }

    public function confirmar(Request $request, tributo $tributo)
    {
        if ($request->user()->perfil->tipo != 'dat') {
            return abort(403, 'No tiene autoridad');
        }

        $tributo->confirmado = true;
        $tributo->save();
        return response('OK', 200);
    }
}
