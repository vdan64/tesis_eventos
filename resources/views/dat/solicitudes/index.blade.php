<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">

{{--        Sin tributo--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <div class="p-6">
                    <h2 class="app-text font-bold">Solicitudes provisionales</h2>
                    <p class="app-text">La siguientes solicitudes deben ser asignadas el tributo a pagar segun
                        corresponda</p>
                    <div class="grid grid-cols-8 gap-2">
                        <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                        <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                        <div class="col-span-full">
                            <hr>
                        </div>
                        <ul class="col-span-full grid-cols-subgrid">
                            @forelse($solicitudesSinTributo as $solicitud)
                                <li>
                                    <a href="{{route('dat.solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                        <div class="grid grid-cols-8">
                                            <p class="app-text col-span-1">{{ date_format($solicitud->created_at, 'd-m-Y') }}</p>
                                            <p class="app-text col-span-2">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                            <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                            <p class="app-text col-span-2">{{ $solicitud->perfil->cedula }}</p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="app-text">No hay solicitudes provisionales pendientes</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>
{{--Con tributo--}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <div class="p-6">
                    <h2 class="app-text font-bold">Solicitudes pendientes</h2>
                    <p class="app-text">La siguientes solicitudes deben ser pagadas por el solicitante y reportadas a fin de confirmar el pago del tributo establecido</p>
                    <div class="grid grid-cols-8 gap-2">
                        <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                        <div class="col-span-1"><p class="app-text text-center">Nro. Solicitud</p></div>
                        <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                        <div class="col-span-1"><p class="app-text text-center">Reportado</p></div>
                        <div class="col-span-full">
                            <hr>
                        </div>
                        <ul class="col-span-full grid-cols-subgrid">
                            @forelse($solicitudesConTributo as $solicitud)
                                @php $tributo = $solicitud->tributo @endphp
                                <li>
                                    <a href="{{route('dat.solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                        <div class="grid grid-cols-8">
                                            <p class="app-text col-span-1">{{ date_format($solicitud->created_at, 'd-m-Y') }}</p>
                                            <p class="app-text col-span-1">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                            <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                            <p class="app-text col-span-2">{{ $solicitud->perfil->cedula }}</p>
                                            <p class="app-text col-span-1 justify-self-center">
                                            @if($tributo->idpago)

                                                <span class="text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </span>

                                            @else

                                                <span class="text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </span>
                                            </p>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="app-text">No hay solicitudes provisionales pendientes</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <div class="p-6">
                    <h2 class="app-text font-bold">Solicitudes definitivas</h2>
                    <div class="grid grid-cols-8 gap-2">
                        <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                        <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                        <div class="col-span-full">
                            <hr>
                        </div>
                        <ul class="col-span-full grid-cols-subgrid">
                            @forelse($solicitudesAprobadas as $solicitud)
                                <li>
                                    <a href="{{route('dat.solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                        <div class="grid grid-cols-8">
                                            <p class="app-text col-span-1">{{ date_format($solicitud->created_at, 'd-m-Y') }}</p>
                                            <p class="app-text col-span-2">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                            <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                            <p class="app-text col-span-2">{{ $solicitud->perfil->cedula }}</p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="app-text">No hay solicitudes provisionales pendientes</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
