<x-guest-layout>
    <div class="max-w-lg w-full mx-auto mt-10">
        <div
            style="box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);"
            class="bg-gray-800 rounded-lg shadow-xl overflow-hidden"
        >
            <div class="p-8">
                <h2 class="text-center text-3xl font-extrabold text-white">
                    Bienvenido!!
                </h2>
                <p class="mt-4 text-center text-gray-400">Inicia Sesion para continuar</p>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf
                    
                    <div class="rounded-md shadow-sm">
                        <!-- Email Address -->
                        <div>
                            <label class="sr-only" for="email">Email address</label>
                            <x-text-input
                                placeholder="Email address"
                                class="appearance-none relative block w-full px-3 py-3 border border-gray-700 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                                id="email"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label class="sr-only" for="password">Password</label>
                            <x-text-input
                                placeholder="Password"
                                class="appearance-none relative block w-full px-3 py-3 border border-gray-700 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                id="password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <input
                                class="h-4 w-4 text-indigo-500 focus:ring-indigo-400 border-gray-600 rounded"
                                type="checkbox"
                                name="remember"
                                id="remember_me"
                            />
                            <label class="ml-2 block text-sm text-gray-400" for="remember_me">
                                Recordar mi cuenta?
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a
                                    class="font-medium text-indigo-500 hover:text-indigo-400"
                                    href="{{ route('password.request') }}"
                                >
                                    Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-gray-900 bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            type="submit"
                        >
                            Ingresar
                        </button>
                    </div>
                </form>
            </div>
            <div class="px-8 py-4 bg-gray-700 text-center">
                <span class="text-gray-400">No tienes una cuenta?</span>
                <a class="font-medium text-indigo-500 hover:text-indigo-400" href="{{ route('register') }}">
                    Crear cuenta
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
