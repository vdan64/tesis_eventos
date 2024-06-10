<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('registro solicitud') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface p-6">
                <form action="{{route('solicitudes.store')}}" method="POST">
                    @csrf

                    <div class="grid grid-cols-8 gap-4">
                        <div class="col-span-4">
                            <x-input-label for="nombre_evento" :value="__('Nombre de evento')"/>
                            <x-text-input id="nombre_evento" class="block mt-1 w-full" type="text" name="nombre_evento"
                                          :value="old('nombre_evento')" required/>
                            <x-input-error :messages="$errors->get('nombre_evento')" class="mt-2"/>
                        </div>

                        <div class="col-start-1 col-end-9">
                            <x-input-label for="descripcion" :value="__('Descripcion')"/>
                            <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                                          :value="old('descripcion')" required/>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2"/>
                        </div>

                        <div class="col-span-full">
                            <div class="grid grid-cols-5 gap-4">
                                <div>
                                    <x-input-label for="fecha_inspeccion" :value="__('Fecha de inspección')"/>
                                    <x-text-input id="fecha_inspeccion" class="block mt-1 w-full" type="date"
                                                  name="fecha_inspeccion" :value="old('fecha_inspeccion')" required/>
                                    <x-input-error :messages="$errors->get('fecha_inspeccion')" class="mt-2"/>
                                </div>

                                <div>
                                    <x-input-label for="fecha_solicitud" :value="__('Fecha de solicitud')"/>
                                    <x-text-input id="fecha_solicitud" class="block mt-1 w-full" type="date"
                                                  name="fecha_solicitud" :value="old('fecha_solicitud')" required/>
                                    <x-input-error :messages="$errors->get('fecha_solicitud')" class="mt-2"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex ">
                            <x-primary-button>Enviar</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
