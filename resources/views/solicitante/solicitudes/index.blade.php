<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <h2 class="app-text font-bold">Solicitudes pendientes</h2>

                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                    <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                    <div class="col-span-full"><hr></div>
                    <ul class="col-span-full grid-cols-subgrid">
                        @forelse($solicitudesPendientes as $solicitud)
                            <li>
                                <a href="{{route('solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                    <div class="grid grid-cols-8">
                                        <p class="app-text col-span-1">{{ date_format($solicitud->created_at, 'd-m-Y') }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                        <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->perfil->cedula }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="app-text">No hay solicitudes pendientes</li>
                        @endforelse
                    </ul>
                </div>

                <div class="py-2">
                    <x-nav-link href="{{ route('solicitudes.create') }}"><x-primary-button>Nueva solicitud</x-primary-button></x-nav-link>

                </div>

            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <h2 class="app-text font-bold">Solicitudes provisionales</h2>

                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-1"><p class="app-text text-center">Fecha aprobacion</p></div>
                    <div class="col-span-1"><p class="app-text text-center">Nro. Solicitud</p></div>
                    <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                    <div class="col-span-1"><p class="app-text text-center">Tributo asignado</p></div>
                    <div class="col-span-1"><p class="app-text text-center">Pago reportado</p></div>
                    <div class="col-span-1"><p class="app-text text-center">Pago confirmado</p></div>
                    <div class="col-span-full"><hr></div>
                    <ul class="col-span-full grid-cols-subgrid">
                        @forelse($solicitudesProvisionales as $solicitud)
                            <li>
                                <a href="{{route('solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                    <div class="grid grid-cols-8 gap-2">
                                        <p class="app-text col-span-1">{{ date_format(date_create($solicitud->fecha_permisoprovisional), 'd-m-Y') }}</p>
                                        <p class="app-text col-span-1">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                        <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                        <div class="app-text col-span-1 justify-self-center">
                                            @if($solicitud->tributo)<x-ok-icon/>@else<x-x-icon/>@endif
                                        </div>
                                        <div class="app-text col-span-1 justify-self-center">
                                            @if($solicitud->tributo?->idpago)<x-ok-icon/>@else<x-x-icon/>@endif
                                        </div>
                                        <div class="app-text col-span-1 justify-self-center">
                                            @if($solicitud->tributo?->confirmado)<x-ok-icon/>@else<x-x-icon/>@endif
                                        </div>

                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="app-text">No hay solicitudes provisonales</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <h2 class="app-text font-bold">Solicitudes definitivas</h2>

                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-1"><p class="app-text text-center">Fecha aprobacion</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                    <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                    <div class="col-span-full"><hr></div>
                    <ul class="col-span-full grid-cols-subgrid">
                        @forelse($solicitudesAprobadas as $solicitud)
                            <li>
                                <a href="{{route('solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                    <div class="grid grid-cols-8">
                                        <p class="app-text col-span-1">{{ date_format($solicitud->fecha_permisodefinitivo, 'd-m-Y') }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                        <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->perfil->cedula }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="app-text">No hay solicitudes aprobadas</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <h2 class="app-text font-bold">Solicitudes rechazadas</h2>

                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-1"><p class="app-text text-center">Fecha rechazo</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                    <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Razón</p></div>
                    <div class="col-span-full"><hr></div>
                    <ul class="col-span-full grid-cols-subgrid">
                        @forelse($solicitudesRechazadas as $solicitud)
                            <li>
                                <a href="{{route('solicitudes.show', ['solicitud' => $solicitud->id])}}">
                                    <div class="grid grid-cols-8">
                                        <p class="app-text col-span-1">{{ date_format($solicitud->fecha_permisodefinitivo, 'd-m-Y') }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->N_solicitud ?: "No asignado"  }}</p>
                                        <p class="app-text col-span-3">{{ $solicitud->descripcion }}</p>
                                        <p class="app-text col-span-2">{{ $solicitud->razon_rechazo }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="app-text">No hay solicitudes rechazadas</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
