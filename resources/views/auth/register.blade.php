<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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

        <!-- Profile Picture -->
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="__('Elige una foto de perfil')" />
            <div class="flex flex-wrap">
                <label class="block w-1/4 p-2">
                    <input type="radio" name="profile_picture" value="1.png" class="hidden" />
                    <img src="{{ asset('images/profile_pictures/1.png') }}" alt="Default" class="border rounded cursor-pointer w-full">
                </label>
                <label class="block w-1/4 p-2">
                    <input type="radio" name="profile_picture" value="2.png" class="hidden" />
                    <img src="{{ asset('images/profile_pictures/2.png') }}" alt="Profile 1" class="border rounded cursor-pointer w-full">
                </label>
                <label class="block w-1/4 p-2">
                    <input type="radio" name="profile_picture" value="3.png" class="hidden" />
                    <img src="{{ asset('images/profile_pictures/3.png') }}" alt="Profile 2" class="border rounded cursor-pointer w-full">
                </label>
                <label class="block w-1/4 p-2">
                    <input type="radio" name="profile_picture" value="4.png" class="hidden" />
                    <img src="{{ asset('images/profile_pictures/4.png') }}" alt="Profile 3" class="border rounded cursor-pointer w-full">
                </label>
                <!-- Añade más imágenes según sea necesario -->
            </div>
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
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

    <style>
    input[type="radio"]:checked + img {
        border: 2px solid #4A90E2;
    }
</style>
</x-guest-layout>
