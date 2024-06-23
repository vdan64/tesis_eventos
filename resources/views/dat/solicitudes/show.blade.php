<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Solicitud') }}
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
                            <x-text-input disabled placeholder="Nro. de solicitud" id="Nsolicitud"
                                          class="block mt-1 w-full" type="text" name="Nsolicitud"
                                          value="{{ $solicitud->N_solicitud ?? '' }}"
                            />
                            <x-input-error :messages="$errors->get('Nsolicitud')" class="mt-2"/>
                        </div>
                        <div class="h-full content-end">

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

                    @if(!$solicitud->tributo)
                        <div x-data>
                            <x-primary-button @click="$dispatch('open-modal', 'tributoModal')">Asignar tributo
                            </x-primary-button>
                        </div>
                    @endif

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
                                @if(!$tributo->confirmado)
                                    <x-primary-button x-data x-on:click="$dispatch('open-modal', 'confirmarPagoModal')">Confirmar pago</x-primary-button>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            @endif
        </div>
    </div>
{{--modals--}}
    <div>
        @if($solicitud->tributo)

        <x-modal name="confirmarPagoModal">
            <div class="p-6">
                <h2 class="app-text text-xl">Confirmar pago</h2>
                <br>

                <p class="app-text">¿Estas seguro que deseas confirmar el pago de los tributos? <br><br>Recuerda realizar esta acción solo cuando se haya podido confirmar los fondos en la cuenta destino.</p>
                <br>
                <div class="flex flex-row-reverse gap-4">
                    <x-primary-button x-on:click="confirmarPago({{ $tributo->id }})">Confirmar</x-primary-button>
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'confirmarPagoModal')">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-modal>

        @else

            <x-modal name="tributoModal">
                <div class="p-6">
                    <h2 class="app-text text-xl">Asignacion de tributo</h2>
                    <br>

                    <div x-data="{descripcion: '', monto: 0}" class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <x-input-label for="descripcion" :value="__('Descripcion')"/>
                            <x-text-input id="descripcion" class="block mt-1 w-full" type="text"
                                          x-model="descripcion" required/>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2"/>
                        </div>

                        <div>
                            <x-input-label for="monto" :value="__('Monto')"/>
                            <x-text-input id="monto" class="block mt-1 w-full" type="text"
                                          x-model="monto" required/>
                            <x-input-error :messages="$errors->get('monto')" class="mt-2"/>
                        </div>

                        <div class="col-span-full flex justify-end">
                            <x-primary-button x-data
                                              @click="asignarTributo({{ $solicitud->id }}, descripcion, monto)">
                                Aceptar
                            </x-primary-button>

                        </div>


                    </div>
                </div>
            </x-modal>

        @endif
    </div>
    <script>
        async function asignarTributo(solicitud, descripcion, monto) {
            const res = await axios.post('/dat/tributos/', {
                solicitud_id: solicitud,
                descripcion: descripcion,
                monto: Number(monto)
            })

            if (res.status === 200) {
                alert('Tributo asignado exitosamente')
                window.location.reload()
            }
        }

        async function confirmarPago(tributo) {
            const res = await axios.patch(`/dat/tributos/${tributo}/confirmar`)
            if (res.status === 200) {
                alert('Pago confirmado exitosamente')
                window.location.reload()
            } else {
                alert('Ha ocurrido un error.')
            }
        }
    </script>

</x-app-layout>
