<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro solicitud') }}
        </h2>
    </x-slot>
    <div class="py-12">

        @if($solicitud->estado == 'pagado')

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="app-surface p-6">
                    <div class="flex items-center gap-4">
                        <x-ok-icon/><p class="app-text"><span class="font-black">Atencion: </span>Esta solicitud se encuentra en espera de emisión de permiso definitivo.</p>
                    </div>
                </div>
            </div>

            <br>
        @endif

        @if($solicitud->estado == 'rechazado')

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="app-surface p-6">
                    <div class="flex items-center gap-4">
                        <x-x-icon/><p class="app-text"><span class="font-black">Atencion: </span>Esta solicitud fue rechazada en <time>{{ date_format($solicitud->updated_at, 'd-m-Y') }}</time>, por la razón descrita a continuación.</p>
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
                        <div class="col-span-1">
                            <x-input-label for="Nsolicitud" :value="__('Numero de solicitud')"/>
                            <x-text-input disabled placeholder="Por asignar" id="Nsolicitud"
                                          class="block mt-1 w-full" type="text" name="Nsolicitud"
                                          value="{{ $solicitud->N_solicitud ?? '' }}"
                            />
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
                                    <div class="dark:bg-gray-900 dark:hover:bg-gray-700 rounded-md p-6 text-center">
                                        <span class="app-text font-bold">RIF <br> Productora</span>
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
                </div>
            </div>

            <br>

            @if($solicitud->tributo)
                @php
                    $tributo = $solicitud->tributo;
                @endphp
                <div x-data="{ descripcion: @js($tributo->descripcion), monto: @js($tributo->monto) }"
                     class="app-surface p-6">
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

                        <div class="col-span-full">
                            <h3 class="app-text font-bold">Información de pago</h3>
                        </div>
                        <div class="col-span-1">
                            <x-input-label for="idpago" :value="__('Referencia de pago')"/>
                            <x-text-input disabled :value="$tributo->monto ?? ''" id="idpago" class="block mt-1 w-full" type="text"
                                          required/>

                        </div>

                        <div class="col-span-1">
                            <x-input-label for="cuenta_destino" :value="__('Cuenta destino')"/>
                            <x-text-input disabled :value="$tributo->cuenta_destino ?? ''" id="cuenta_destino" class="block mt-1 w-full" type="text"
                                          required/>

                        </div>

                        <div class="col-span-1">
                            <x-input-label for="fechapago" :value="__('Fecha de pago')"/>
                            <x-text-input disabled :value="$tributo->fechapago ?? ''" id="fechapago" class="block mt-1 w-full" type="text"
                                          required/>

                        </div>

                        <div class="col-span-1 flex flex-col justify-evenly items-center justify-self-center">
                            <div class="grid grid-cols-2 gap-4 justify-items-center">
                                <div class="col-span-1">
                                    <x-input-label for="fechapago" :value="__('Reportado')"/>
                                    @if($tributo->idpago)
                                        <x-ok-icon/>
                                    @else
                                        <x-x-icon/>
                                    @endif
                                </div>
                                <div class="col-span-1">
                                    <x-input-label for="fechapago" :value="__('Confirmado')"/>
                                    @if($tributo->confirmado)
                                        <x-ok-icon/>
                                    @else
                                        <x-x-icon/>
                                    @endif
                                </div>

                            </div>

                        </div>
                        {{--                        Opciones--}}
                        <div class="col-span-full">
                            <div class="flex gap-4">
                                @if(!$tributo->idpago)
                                    <x-primary-button x-data x-on:click="$dispatch('open-modal', 'reportarPagoModal')">
                                        Reportar pago
                                    </x-primary-button>
                                @endif
                                @if($tributo->confirmado)
{{--                                        <x-primary-button x-data x-on:click="$dispatch('open-modal', 'solicitarPermisoDefinitivoModal')">--}}
{{--                                            Solicitar permiso definitivo--}}
{{--                                        </x-primary-button>--}}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <script>
                    async function reportarPago(tributo, referencia, cuenta, fecha) {
                        const res = await axios.patch(`/tributos/${tributo}/reportarpago`, {
                            idpago: referencia,
                            cuenta_destino: cuenta,
                            fechapago: fecha
                        })

                        if (res.status === 200) {
                            alert('Pago reportado exitosamente. Debe esperar que sea confirmado para solicitar el permiso definitivo')
                            window.location.reload()
                        } else {
                            alert('Ocurrió un error: ' + res.statusText)
                        }
                    }
                </script>
            @endif
        </div>
    </div>

    <div>
{{--        modals--}}
        @if($solicitud->tributo && ! $solicitud->tributo->idpago)
        <x-modal name="reportarPagoModal">
            <div x-data="{ idpago: '', cuenta_destino: '', fechapago: null }"  class="p-6">
                <h2 class="app-text text-xl">Reporte de pago</h2>
                <br>
                <p class="app-text">Ingrese la informacion de pago de los tributos</p>
                <br>
                {{--                form--}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <x-input-label for="idpago" :value="__('Referencia')"/>
                        <x-text-input id="idpago" x-model="idpago"/>
                    </div>
                    <div class="col-span-1">
                        <x-input-label for="cuenta_destino" :value="__('Cuenta destino')"/>
                        <x-text-input id="cuenta_destino" x-model="cuenta_destino"/>
                    </div>
                    <div class="col-span-1">
                        <x-input-label for="fechapago" :value="__('Fecha de pago')"/>
                        <x-text-input id="fechapago" x-model="fechapago" type="date"/>
                    </div>
                    <div class="col-span-1">
                        <x-input-label for="fechapago" :value="__('Monto')"/>
                        <x-text-input :disabled="true" id="fechapago" :value="$solicitud->tributo->monto"/>
                    </div>
                </div>
                <br>

                <div class="flex flex-row-reverse gap-4">
                    <x-primary-button x-on:click="reportarPago({{ $tributo->id }}, idpago, cuenta_destino, fechapago)">Confirmar</x-primary-button>
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'reportarPagoModal')">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-modal>
        @endif
        @if($solicitud->tributo && $solicitud->tributo->confirmado)
            <x-modal name="solicitarPermisoDefinitivoModal">
                <div class="p-6">
                    <h2 class="app-text font-bold text-xl">Solicitar permiso definitivo</h2>
                    <br>
                    <p class="app-text">Se procederá a emitir el permiso definitivo del evento.</p>
                    <br>
                    <div class="flex flex-row-reverse gap-4">
                        <x-primary-button x-on:click="solicitarPermisoDef()">Solicitar</x-primary-button>
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'solicitarPermisoDefinitivoModal')">Cancelar</x-secondary-button>
                    </div>
                </div>
                <script>
                    async function solicitarPermisoDef() {
                        console.log('Emitido')
                        alert('Permiso definitivo emitido exitosamente.')
                        window.location.reload()
                    }
                </script>
            </x-modal>
        @endif
    </div>
</x-app-layout>
