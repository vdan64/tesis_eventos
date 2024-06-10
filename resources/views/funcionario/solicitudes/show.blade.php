<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('registro solicitud') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="app-surface">
                <form action="{{route('solicitudes.store')}}" method="POST" class="flex flex-col gap-2 w-36">
                    @csrf
                    <label for="" class="text-white">Nombre de evento</label>
                    <input disabled name="nombre_evento" class="bg-transparent mt-4"
                           value="{{ $solicitud->nombre_evento }}"></input>

                    <label for="" class="text-white">Descripcion</label>
                    <textarea disabledrea name="descripcion" class="bg-transparent mt-4">{{ $solicitud->descripcion }}</textarea>

                    <label for="fecha_inspeccion" class="text-white">Fecha de inspeccion</label>
                    <input disabled type="date" name="fecha_inspeccion" class="bg-transparent mt-4"
                           value="{{ $solicitud->fecha_inspeccion}}">

                    <label for="fecha_solicitud" class="text-white">Fecha solicitud</label>
                    <input disabled type="date" name="fecha_solicitud" class="bg-transparent mt-4"
                           value="{{ $solicitud->fecha_solicitud}}">

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
