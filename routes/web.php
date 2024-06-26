<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TributoController;
use Illuminate\Support\Facades\Route;
use App\Models\solicitud;


Route::get('/', function () {
    return view('welcome2');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified']);


Route::middleware(['auth', 'role:solicitante'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::withoutMiddleware(['role:solicitante'])->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/informacion', function () {
        return view('informacion');
    });

    Route::get('/solicitudes/index', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::get('/solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/solicitudes/create', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show');

    Route::prefix('tributos')->name('tributos.')->group(function () {
        Route::get('/', [TributoController::class, 'index'])->name('index');
        Route::patch('/{tributo}/reportarpago', [TributoController::class, 'reportar'])->name('reportarpago');
    });


    Route::get('/permisos', function () {
        return view('permisos');
    });
    Route::get('/permisos-pagados', function () {
        return view('permisos-pagados');
    });

});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:funcionario'])->group(function () {
    Route::get('/dashboard', function () {
        return view('funcionario.dashboard');
    })->name('dashboard');

    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show');
    Route::patch('/solicitudes/{solicitud}/aprobar', [SolicitudController::class, 'aprobar']);
    Route::patch('/solicitudes/{solicitud}/asignarnumero', [SolicitudController::class, 'asignarNumero']);
    Route::patch('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])->name('solicitudes.rechazar');
    Route::post('/solicitudes/{solicitud}/aprobardef', [SolicitudController::class, 'aprobarPermisoDefinitivo'])->name('solicitudes.aprobar.def');

    Route::prefix('tributos')->name('tributo.')->group(function () {
        Route::get('/', [TributoController::class, 'index'])->name('index');
        Route::get('/{tributo}', [TributoController::class, 'show'])->name('show');
        Route::post('/', [TributoController::class, 'create'])->name('store');
        Route::patch('/{tributo}/reportar', [TributoController::class, 'reportar']);
    });


});

Route::prefix('dat')->name('dat.')->middleware(['auth', 'role:dat'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dat.dashboard');
    })->name('dashboard');

    Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
        Route::get('/', [SolicitudController::class, 'index'])->name('index');
    });

    Route::prefix('tributos')->name('tributos.')->group(function () {
        Route::get('/', [TributoController::class, 'index'])->name('index');
        Route::get('/{tributo}', [TributoController::class, 'show'])->name('show');
        Route::get('/create', [TributoController::class, 'create'])->name('create');
        Route::post('/', [TributoController::class, 'store'])->name('store');
        Route::patch('/{tributo}/reportar', [TributoController::class, 'reportar'])->name('reportar');
        Route::patch('/{tributo}/confirmar', [TributoController::class, 'confirmar'])->name('confirmar');
    });

    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show');

});

// files routes
Route::middleware(['auth'])->group(function () {
    Route::get('rif/{file}', [SolicitudController::class, 'getFile']);
    Route::get('permiso/{file}', [SolicitudController::class, 'getFile']);
    Route::get('permiso_prov/{file}', [SolicitudController::class, 'getFile']);
    Route::get('permiso_def/{file}', [SolicitudController::class, 'getFile']);
});


require __DIR__ . '/auth.php';
