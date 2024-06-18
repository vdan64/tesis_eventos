<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido, ") . Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-full">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="p-6 text-gray-900 dark:text-gray-100 text-xl font-extrabold">Menu</h2>
                </div>
            </div>
            <a href="{{ route('admin.solicitudes.index') }}"><div class="rounded bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"><p class="p-6 text-gray-900 dark:text-gray-100">Eventos</p></div></a>
            <a href=""><div class="rounded bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"><p class="p-6 text-gray-900 dark:text-gray-100">Opcion 2</p></div></a>
            <a href=""><div class="rounded bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"><p class="p-6 text-gray-900 dark:text-gray-100">Opcion 3</p></div></a>
            <a href=""><div class="rounded bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"><p class="p-6 text-gray-900 dark:text-gray-100">Opcion 4</p></div></a>
        </div>
    </div>

</x-app-layout>