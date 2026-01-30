@extends('layouts.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/configuracion.css') }}">
@endpush

@section('title', 'Configuración de Perfil')

@section('content')
<main class="contenedor-perfil">

    <aside class="sidebar-perfil">
        <div class="tarjeta-usuario">
            <div class="avatar">
                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->profile?->surname ?? '', 0, 1)) }}</span>
            </div>
            <h2>{{ Auth::user()->name }} {{ Auth::user()->profile?->surname ?? '' }}</h2>
            <p class="email-usuario">{{ Auth::user()->email }}</p>

            <nav class="menu-perfil">
                <a href="{{ route('perfil') }}">🚗 Mi Garaje</a>
                <a href="{{ route('perfil') }}#citas">📅 Mis Citas</a>
                <a href="{{ route('perfil') }}#facturas">📄 Facturas</a>
                <a href="{{ route('configuracion') }}" class="activo">⚙️ Configuración</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background:none; border:none; color: inherit; font: inherit; cursor: pointer; padding: 10px 0;">🚪 Cerrar Sesión</button>
                </form>
            </nav>
        </div>
    </aside>

    <section class="contenido-dashboard">
        @if(session('status') === 'profile-updated')
            <div class="mensaje-exito">El perfil se ha actualizado correctamente.</div>
        @endif

        <div class="contenedor-formulario">
            <div class="header-seccion">
                <h2>Información Personal</h2>
                <p>Actualiza la información de tu cuenta y dirección de correo electrónico.</p>
            </div>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="grid-formulario">
                    <div class="grupo-input">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                        @error('name') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                    <div class="grupo-input">
                        <label for="surname">Apellidos</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname', $user->profile?->surname) }}">
                        @error('surname') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                    <div class="grupo-input campo-full">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                    <div class="grupo-input campo-full">
                        <label for="phone">Teléfono</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->profile?->phone) }}">
                        @error('phone') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="boton-guardar">Guardar Cambios</button>
            </form>
        </div>

        <div class="contenedor-formulario">
            <div class="header-seccion">
                <h2>Seguridad</h2>
                <p>Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.</p>
            </div>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="grid-formulario">
                    <div class="grupo-input campo-full">
                        <label for="current_password">Contraseña Actual</label>
                        <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                        @error('current_password') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                    <div class="grupo-input">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" autocomplete="new-password">
                        @error('password') <span class="error-texto">{{ $message }}</span> @enderror
                    </div>
                    <div class="grupo-input">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
                <button type="submit" class="boton-guardar">Actualizar Contraseña</button>
            </form>
        </div>
    </section>

</main>
@endsection
