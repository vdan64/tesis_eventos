<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;
use App\Models\solicitud;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/informacion', function () {
        return view('informacion');
      });
      
      Route::get('/solicitudes/index', [SolicitudController::class, 'index'])->name('solicitudes.index'); 
      Route::get('/solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
      Route::post('/solicitudes/create', [SolicitudController::class, 'store'])->name('solicitudes.store');
      Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show');  
      
      
      Route::get('/solicitud/{id}', function(solicitud $solicitud) {
        return view('solicitud', ['solicitud' => $solicitud]);
      });
      Route::get('/permisos', function () {
        return view('permisos');
      });
      Route::get('/permisos-pagados', function () {
        return view('permisos-pagados');
      });



});

Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('/dashboard', function () {
    return view('funcionario.dashboard');
  })->name('dashboard');

  Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
  

})->middleware(['auth']);



require __DIR__.'/auth.php';
