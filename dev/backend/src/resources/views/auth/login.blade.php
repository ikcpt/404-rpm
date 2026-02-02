<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="racing-body">

        <div class="racing-card">
            <div class="racing-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="var(--color-acento)">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <h2 class="racing-title">INICIAR SESIÓN</h2>
                <p class="racing-subtitle">Introduce tus credenciales</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <input id="email" class="input-racing" type="email" name="email" :value="old('email')" required
                        autofocus autocomplete="username" placeholder="Identificación (Email)">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <div class="input-group">
                    <input id="password" class="input-racing" type="password" name="password" required
                        autocomplete="current-password" placeholder="Código de Acceso">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <button type="submit" class="btn-turbo">
                    Iniciar sesión
                </button>

                <div class="form-links">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">¿Olvidaste la clave?</a>
                    @endif
                    <a href="{{ route('register') }}" style="color: var(--color-acento); font-weight:bold;">Crear
                        Cuenta</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>