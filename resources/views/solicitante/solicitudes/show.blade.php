<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro solicitud') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">

                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-4">
                        <x-input-label for="nombre_evento" :value="__('Nombre de evento')"/>
                        <x-text-input disabled value="{{ $solicitud->nombre_evento }}" id="nombre_evento" class="block mt-1 w-full" type="text" name="nombre_evento"
                        />
                        <x-input-error :messages="$errors->get('nombre_evento')" class="mt-2"/>
                    </div>

                    <div class="col-span-4 grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <x-input-label for="Nsolicitud" :value="__('Numero de solicitud')"/>
                            <x-text-input disabled placeholder="Por asignar" id="Nsolicitud"
                                          class="block mt-1 w-full" type="text" name="Nsolicitud" value="{{ $solicitud->N_solicitud ?? '' }}"
                            />
                        </div>

                    </div>

                    <div class="col-start-1 col-end-9">
                        <x-input-label for="descripcion" :value="__('Descripcion')"/>
                        <x-text-input disabled value="{{ $solicitud->descripcion }}" id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                        />
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2"/>
                    </div>
                    <div class="col-span-full">
                        <div class="grid grid-cols-5 gap-4">
                            <div>
                                <x-input-label for="fecha_inspeccion" :value="__('Fecha de inspección')"/>
                                <x-text-input disabled value="{{ $solicitud->fecha_inspeccion }}" id="fecha_inspeccion" class="block mt-1 w-full" type="date"
                                              name="fecha_inspeccion" required/>
                                <x-input-error :messages="$errors->get('fecha_inspeccion')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="fecha_solicitud" :value="__('Fecha de solicitud')"/>
                                <x-text-input disabled value="{{ $solicitud->fecha_solicitud }}" id="fecha_solicitud" class="block mt-1 w-full" type="date"
                                              name="fecha_solicitud" required/>
                                <x-input-error :messages="$errors->get('fecha_solicitud')" class="mt-2"/>
                            </div>

                            <div class="col-span-2">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="numero_entradas" :value="__('Numero de entradas')"/>
                                        <x-text-input disabled id="numero_entradas" class="block mt-1 w-full" type="number" min="0" value="{{ $solicitud->numero_entradas }}"
                                                      name="numero_entradas" required/>

                                    </div>
                                    <div>
                                        <x-input-label for="numero_funciones" :value="__('Numero de funciones')"/>
                                        <x-text-input disabled id="numero_funciones" class="block mt-1 w-full" type="number" min="0" value="{{ $solicitud->numero_funciones }}"
                                                      name="numero_funciones" required/>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-full"><x-input-label :value="__('Archivos')"/></div>

                            <div class="col-span-1">
                                <a href="{{ asset($solicitud->url_rif) }}" target="_blank">
                                    <div class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center">
                                        <span class="app-text font-bold">RIF <br> Productora</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-span-1">
                                <a href="{{ asset($solicitud->url_permiso) }}" target="_blank">
                                    <div class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center h-full place-content-center">
                                        <span class="app-text font-bold">Permiso establecimiento</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
