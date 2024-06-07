<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- cedula -->
        <div class="mt-4">
            <x-input-label for="cedula" :value="__('cedula')" />
            <x-text-input id="cedula" class="block mt-1 w-full" type="string" name="cedula" :value="old('cedula')" required autofocus autocomplete="cedula" />
            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
        </div>

        <!-- rif -->
        <div class="mt-4">
            <x-input-label for="rif" :value="__('rif')" />
            <x-text-input id="rif" class="block mt-1 w-full" type="string" name="rif" :value="old('rif')" required autofocus autocomplete="rif" />
            <x-input-error :messages="$errors->get('rif')" class="mt-2" />
        </div>

        <!-- direccion -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('direccion')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="string" name="direccion" :value="old('direccion')" required autofocus autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- telefono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('telefono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="string" name="telefono" :value="old('telefono')" required autofocus autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
