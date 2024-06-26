<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro solicitud') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if($solicitud->estado == 'rechazado')

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="app-surface p-6">
                    <div class="flex items-center gap-4">
                        <x-x-icon/>
                        <p class="app-text"><span class="font-black">Atencion: </span>Esta solicitud fue rechazada en
                            <time>{{ date_format($solicitud->updated_at, 'd-m-Y') }}</time>
                            , por la razón descrita a continuación.
                        </p>
                    </div>
                    <br>
                    <div>
                        <p class="app-text">
                            {{ $solicitud->razon_rechazo }}
                        </p>
                    </div>
                </div>
            </div>

            <br>

        @endif


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
                                          class="block mt-1 w-full" type="text" name="Nsolicitud"
                                          value="{{ $solicitud->N_solicitud ?? '' }}"
                            />
                            <x-input-error :messages="$errors->get('Nsolicitud')" class="mt-2"/>
                        </div>
                        <div class="h-full content-end">
                            @if($solicitud->estado == 'pendiente')
                                <x-primary-button x-init="" x-on:click="asignarNumero({{ $solicitud->id }})">Asignar
                                    numero de solicitud
                                </x-primary-button>
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

                    @if($solicitud->estado == 'provisional' || $solicitud->estado == 'pagado' || $solicitud->estado == 'aprobado')

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

                    @if($solicitud->estado == 'aprobado')

                        <div class="col-span-full">
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-full">
                                    <x-input-label :value="__('Permiso definitivo')"/>
                                </div>
                                <div class="col-span-1">
                                    <a href="{{ asset($solicitud->permiso_definitivo) }}" target="_blank">
                                        <div
                                            class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center h-full place-content-center">
                                            <span class="app-text font-bold">Permiso definitivo</span>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="flex">
                        @if($solicitud->estado == 'pendiente')
                            {{--                            opciones--}}
                            <div class="grid" x-data="{ open: false }">

                                <div class="flex gap-4">
                                    <x-danger-button x-on:click="$dispatch('open-modal', 'rechazarModal')">Rechazar
                                    </x-danger-button>
                                    <x-primary-button @class('shrink-0') x-on:click="open = !open">Aprobar permiso
                                        provisional
                                    </x-primary-button>
                                </div>

                                {{--Modal--}}
                                <div x-cloak
                                     class="fixed h-screen w-screen top-0 start-0 flex justify-center items-center"
                                     x-show="open">
                                    <div x-on:click="open = false"
                                         class="h-screen w-screen fixed top-0 start-0 bg-black opacity-60"></div>
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



            @if($solicitud->tributo)
                @php
                    $tributo = $solicitud->tributo;
                @endphp

                <br>
                <div x-data="{ descripcion: @js($tributo->descripcion), monto: @js($tributo->monto) }" class="app-surface p-6">
                    <h2 class="app-text font-bold">Tributo asignado</h2>
                    <br>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-3">
                            <x-input-label for="descripcion" :value="__('Descripcion')"/>
                            <x-text-input disabled id="descripcion" class="block mt-1 w-full" type="text"
                                          x-model="descripcion" required/>

                        </div>

                        <div class="col-span-1">
                            <x-input-label for="monto" :value="__('Monto')"/>
                            <x-text-input disabled id="monto" class="block mt-1 w-full" type="text"
                                          x-model="monto" required/>

                        </div>

                        @if ($tributo->idpago)
                            <div class="col-span-full">
                                <h3 class="app-text font-bold">Información de pago</h3>
                            </div>
                            <div class="col-span-1">
                                <x-input-label for="idpago" :value="__('Referencia de pago')"/>
                                <x-text-input disabled :value="$tributo->idpago" id="idpago" class="block mt-1 w-full" type="text"
                                              required/>

                            </div>

                            <div class="col-span-1">
                                <x-input-label for="cuenta_destino" :value="__('Cuenta destino')"/>
                                <x-text-input disabled :value="$tributo->cuenta_destino" id="cuenta_destino" class="block mt-1 w-full" type="text"
                                              required/>

                            </div>

                            <div class="col-span-1">
                                <x-input-label for="fechapago" :value="__('Fecha de pago')"/>
                                <x-text-input disabled :value="date_format(date_create_from_format('Y-m-d', $tributo->fechapago), 'd-m-Y')" id="fechapago" class="block mt-1 w-full" type="text"
                                              required/>

                            </div>

                            <div class="col-span-1 flex flex-col justify-evenly items-center justify-self-center">
                                <x-input-label for="fechapago" :value="__('Confirmado')"/>
                                @if($tributo->confirmado)
                                    <x-ok-icon/>
                                @else
                                    <x-x-icon/>
                                @endif
                            </div>
                            {{--                        Opciones--}}
                            <div class="col-span-full">
                                <div class="flex">
                                    @if($solicitud->estado == 'pagado')
                                        <x-primary-button x-on:click="$dispatch('open-modal', 'aprobarPermisoDefModal')">Aprobar permiso definitivo</x-primary-button>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            @endif
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
            axios.patch(`/admin/solicitudes/${id}/asignarnumero`, {numero: numero}).then(res => {
                if (res.status === 200) {
                    alert("Numero asignado")
                    window.location.assign('/admin/solicitudes/')
                }
            })
        }

        async function rechazarSolicitud(solicitud, razon) {

            const res = await axios.patch(`/admin/solicitudes/${solicitud}/rechazar`, {
                razon_rechazo: razon
            })

            if (res.status === 200) {
                alert('La solicitud ha sido rechazada exitosamente.')
                window.location.reload()
            } else {
                alert('Ocurrio un error')
            }
        }

    </script>


        {{--        modals--}}
        <div>
            @if($solicitud->estado == 'pendiente')
            <x-modal name="rechazarModal">
                <div x-data="{razon_rechazo: ''}" class="p-6">
                    <h2 class="app-text text-xl">Rechazar solicitud</h2>
                    <br>
                    <p class="app-text">Esta apunto de rechazar la presente solicitud. Describa las razones.</p>
                    <br>
                    <div class="grid grid-col-2">

                        <x-input-label for="razon_rechazo" :value="__('Razón o explicación')"/>
                        <x-text-input x-model="razon_rechazo" id="razon_rechazo" class="block mt-1 w-full"
                                      required/>
                    </div>
                    <br>
                    <div class="flex flex-row-reverse gap-4">
                        <x-danger-button x-on:click="rechazarSolicitud({{ $solicitud->id }}, razon_rechazo)">Rechazar
                        </x-danger-button>
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'rechazarModal')">Cancelar
                        </x-secondary-button>
                    </div>
                </div>
            </x-modal>
            @endif
            @if ($solicitud->estado == 'pagado')
                <x-modal name="aprobarPermisoDefModal">
                    <div class="p-6">
                        <h2 class="app-text text-xl">Aprobar permiso definitivo</h2>
                        <br>
                        <p class="app-text">Esta apunto de aprobar el permiso definitivo de esta solicitud. ¿Desea proceder?</p>
                        <br>
                        <div class="flex flex-row-reverse gap-4">
                            <x-primary-button x-on:click="aprobarPermisoDef({{ $solicitud->id }})">Aprobar
                            </x-primary-button>
                            <x-secondary-button x-on:click="$dispatch('close-modal', 'aprobarPermisoDefModal')">Cancelar
                            </x-secondary-button>
                        </div>
                    </div>
                    <script>
                        async function aprobarPermisoDef(solicitud) {
                            const res = await axios.post(`/admin/solicitudes/${solicitud}/aprobardef`)
                            if (res.status === 200) {
                                alert('Permiso definitivo aprobado exitosamente.')
                            } else {
                                alert('Ocurrio un error.')
                            }
                            window.location.reload()
                        }
                    </script>
                </x-modal>
                @endif
        </div>
</x-app-layout>
