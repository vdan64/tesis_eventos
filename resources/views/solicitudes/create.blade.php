<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('registro solicitud') }}
        </h2>
    </x-slot>

    



    <div class="w-1/2">
        <form action="{{route('solicitudes.store')}}" method="POST" class="flex flex-col gap-2 w-36">
            @csrf
            <label for="" class="text-white">Nombre de evento</label>
            <input name="nombre_evento" class="bg-transparent mt-4"></input>

            <label for="" class="text-white">Descripcion</label>
            <textarea name="descripcion" class="bg-transparent mt-4"></textarea>
            
            <label for="fecha_inspeccion" class="text-white">Fecha de inspeccion</label>
            <input type="date" name="fecha_inspeccion" class="bg-transparent mt-4">
            
            <label for="fecha_solicitud" class="text-white">Fecha solicitud</label>
            <input type="date" name="fecha_solicitud" class="bg-transparent mt-4">
            
            <x-primary-button>Enviar</x-primary-button>

        </form>
    </div>

</x-app-layout>