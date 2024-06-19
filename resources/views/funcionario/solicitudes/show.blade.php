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
                        <x-text-input disabled value="{{ $solicitud->nombre_evento }}" id="nombre_evento"
                                      class="block mt-1 w-full" type="text" name="nombre_evento"
                        />
                        <x-input-error :messages="$errors->get('nombre_evento')" class="mt-2"/>
                    </div>

                    <div class="col-span-4 grid grid-cols-2 gap-4">
                        <div class="">
                            <x-input-label for="Nsolicitud" :value="__('Numero de solicitud')"/>
                            <x-text-input placeholder="Nro. de solicitud" id="Nsolicitud"
                                          class="block mt-1 w-full" type="text" name="Nsolicitud" value="{{ $solicitud->N_solicitud ?? '' }}"
                            />
                            <x-input-error :messages="$errors->get('Nsolicitud')" class="mt-2"/>
                        </div>
                        <div class="h-full content-end">
                            @if($solicitud->estado == 'pendiente')
                                <x-primary-button x-init="" x-on:click="asignarNumero({{ $solicitud->id }})">Asignar numero de solicitud</x-primary-button>
                            @endif
                        </div>
                    </div>

                    <div class="col-start-1 col-end-9">
                        <x-input-label for="descripcion" :value="__('Descripcion')"/>
                        <x-text-input disabled value="{{ $solicitud->descripcion }}" id="descripcion"
                                      class="block mt-1 w-full" type="text" name="descripcion"
                        />
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2"/>
                    </div>
                    <div class="col-span-full">
                        <div class="grid grid-cols-5 gap-4">
                            <div>
                                <x-input-label for="fecha_inspeccion" :value="__('Fecha de inspección')"/>
                                <x-text-input disabled value="{{ $solicitud->fecha_inspeccion }}" id="fecha_inspeccion"
                                              class="block mt-1 w-full" type="date"
                                              name="fecha_inspeccion" required/>
                                <x-input-error :messages="$errors->get('fecha_inspeccion')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="fecha_solicitud" :value="__('Fecha de solicitud')"/>
                                <x-text-input disabled value="{{ $solicitud->fecha_solicitud }}" id="fecha_solicitud"
                                              class="block mt-1 w-full" type="date"
                                              name="fecha_solicitud" required/>
                                <x-input-error :messages="$errors->get('fecha_solicitud')" class="mt-2"/>
                            </div>

                            <div class="col-span-2">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="numero_entradas" :value="__('Numero de entradas')"/>
                                        <x-text-input disabled id="numero_entradas" class="block mt-1 w-full"
                                                      type="number" min="0" value="{{ $solicitud->numero_entradas }}"
                                                      name="numero_entradas" required/>

                                    </div>
                                    <div>
                                        <x-input-label for="numero_funciones" :value="__('Numero de funciones')"/>
                                        <x-text-input disabled id="numero_funciones" class="block mt-1 w-full"
                                                      type="number" min="0" value="{{ $solicitud->numero_funciones }}"
                                                      name="numero_funciones" required/>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-full">
                                <x-input-label :value="__('Archivos')"/>
                            </div>
                            <div class="col-span-1">
                                <a href="{{ asset($solicitud->url_rif) }}" target="_blank">
                                    <div
                                        class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center h-full place-content-center">
                                        <span class="app-text font-bold">RIF Productora</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-span-1">
                                <a href="{{ asset($solicitud->url_permiso) }}" target="_blank">
                                    <div
                                        class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center h-full place-content-center">
                                        <span class="app-text font-bold">Permiso establecimiento</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
@if($solicitud->estado == 'provisional')

                    <div class="col-span-full">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-full">
                                <x-input-label :value="__('Permiso provisional')"/>
                            </div>
                            <div class="col-span-1">
                                <a href="{{ asset($solicitud->permiso_provisional) }}" target="_blank">
                                    <div
                                        class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center h-full place-content-center">
                                        <span class="app-text font-bold">Permiso provisional</span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
@endif

                    <div class="flex">
                        @if($solicitud->estado == 'pendiente')
                            <div x-data="{ open: false }">


                                <x-primary-button x-on:click="open = !open">Aprobar permiso provisional
                                </x-primary-button>

                                {{--Modal--}}
                                <div x-cloak
                                     class="fixed h-screen w-screen top-0 start-0 flex justify-center items-center"
                                     x-show="open">
                                    <div x-on:click="open = false"
                                         class="h-screen w-screen fixed top-0 start-0 bg-black opacity-60 backdrop-blur-xl"></div>
                                    <div
                                        class="w-[250px] h-min flex flex-col p-4 relative items-center justify-center bg-gray-800 border border-gray-800 shadow-lg rounded-2xl">
                                        <div class="">
                                            <div class="text-center p-3 flex-auto justify-center">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-12 h-12 flex items-center text-gray-600 mx-auto"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <h2 class="text-xl font-bold py-4 text-gray-200">Aprobar permiso
                                                    provisional</h2>
                                                <p class="text-sm text-gray-500 px-2">
                                                    Desea aprobar el permiso provisional de la presente solicitud?
                                                </p>
                                            </div>
                                            <div class="p-2 mt-2 text-center space-x-1 flex flex-row gap-x-2">
                                                <button x-on:click="open = false"
                                                        class="mb-2 md:mb-0 bg-gray-700 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border-2 border-gray-600 hover:border-gray-700 text-gray-300 rounded-full hover:shadow-lg hover:bg-gray-800 transition ease-in duration-300"
                                                >
                                                    Cancelar
                                                </button>
                                                <button @click="aprobarSolicitud({{$solicitud->id}})"
                                                        class="bg-green-400 hover:bg-green-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300"
                                                >
                                                    Confirmar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        async function aprobarSolicitud(id) {

            axios.patch(`/admin/solicitudes/${id}/aprobar`).then(res => {
                if (res.status === 200) {
                    window.location.assign('/admin/solicitudes/')
                }
            })

        }

        function asignarNumero(id) {

            const numero = document.getElementById('Nsolicitud').value
            axios.patch(`/admin/solicitudes/${id}/asignarnumero`, { numero: numero }).then( res => {
                if (res.status === 200) {
                    alert("Numero asignado")
                    window.location.assign('/admin/solicitudes/')
                }
                })
        }

    </script>

</x-app-layout>
