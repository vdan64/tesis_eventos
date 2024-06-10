<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <div class="p-6">
                    <h2 class="app-text font-bold">Solicitudes pendientes</h2>

                    <div class="grid grid-cols-8">
                        <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                        <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                        <div class="col-span-full">
                            <hr>
                        </div>
                        <div>
                            <p class="app-text"></p>
                            <ul>
                                @foreach($solicitudesPendientes as $solicitud)
                                    <li>
                                        <a href="">
                                            <div class="flex flex-row">
                                                <p class="app-text">{{ $solicitud->N_solicitud }}</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <div class="p-6">
                    <h2 class="app-text font-bold">Solicitudes aprobadas</h2>

                    <div class="grid grid-cols-8">
                        <div class="col-span-1"><p class="app-text text-center">Fecha</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Nro. Solicitud</p></div>
                        <div class="col-span-3"><p class="app-text text-center">Nombre de evento</p></div>
                        <div class="col-span-2"><p class="app-text text-center">Solicitante</p></div>
                        <div class="col-span-full">
                            <hr>
                        </div>
                        <div>
                            <p class="app-text"></p>
                            <ul>
                                @foreach($solicitudesAprobadas as $solicitud)
                                    <li class="grid">
                                        <a href="">
                                            <div class="flex flex-row">
                                                <p class="app-text">{{ $solicitud->N_solicitud }}</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
