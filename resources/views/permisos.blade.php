<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('permisos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        @if (Auth::user()->perfil->tipo == 'solicitante')
            <ul>
            @foreach (Auth::user()->perfil->solicitudes as $solicitud)
                
            @endforeach
            </ul>
        @else
            <ul>
            @foreach (Auth::user()->perfil->solicitud as $solicitud)
                <li class="bg-white"><a href="{{'/solicitud/' . $solicitud->id}}">solicitud numero: {{ $solicitud->id }}</a></li>
            @endforeach
            </ul>
        @endif
    </div>

</x-app-layout>