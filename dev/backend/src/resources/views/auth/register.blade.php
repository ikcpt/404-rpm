<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="racing-body">

        <div class="racing-card red-accent">
            <div class="racing-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="var(--color-secundario)">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <h2 class="racing-title" style="color: var(--color-secundario);">Nuevo Registro</h2>
                <p class="racing-subtitle">Únete a la escudería 404 RPM</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <input id="name" class="input-racing" type="text" name="name" :value="old('name')" required
                        autofocus placeholder="Nombre de Piloto">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                </div>

                <div class="input-group">
                    <input id="email" class="input-racing" type="email" name="email" :value="old('email')" required
                        placeholder="Correo Electrónico">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <div class="input-group">
                    <input id="password" class="input-racing" type="password" name="password" required
                        placeholder="Contraseña">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <div class="input-group">
                    <input id="password_confirmation" class="input-racing" type="password" name="password_confirmation"
                        required placeholder="Confirmar Contraseña">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <button type="submit" class="btn-turbo red">
                    Registrarme
                </button>

                <div class="form-links">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>