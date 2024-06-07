<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('inspeccion') }}
        </h2>
    </x-slot>

    <div class="text-white">
        {{ $inspeccion }}

        <input class="text-black" type="text" value="{{ $solicitud->fecha_solicitud}}">
    </div>

</x-app-layout>