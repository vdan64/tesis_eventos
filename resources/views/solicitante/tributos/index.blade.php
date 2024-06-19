<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <h2 class="app-text font-bold">Tributos pendientes</h2>

                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                    <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                    <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                    <div class="col-span-full"><hr></div>
                    <ul class="col-span-full grid-cols-subgrid">
                        @forelse($tributosPendientes as $tributo)
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
                            <li class="app-text">No hay tributos pendientes por pagar</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

    </div>

</x-app-layout>
