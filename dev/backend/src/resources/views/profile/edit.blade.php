@extends('layouts.layout')

@section('title', 'Configuración | 404 RPM')

@section('content')

<style>
/* --- 1. LAYOUT GENERAL --- */
.layout-perfil {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    align-items: start;
}

/* --- 2. SIDEBAR GAMIFICADA --- */
.sidebar-perfil {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    text-align: center;
    position: sticky;
    top: 20px;
}

.nivel-badge {
    background: linear-gradient(135deg, #1a4a9c, #0d2e6b);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(26, 74, 156, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.puntos-rpm {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    padding: 12px;
    border-radius: 10px;
    margin-top: 20px;
    font-size: 0.9rem;
    color: #555;
}

.puntos-rpm strong {
    color: #dc3545;
    font-size: 1.2rem;
}

/* --- 3. CONTENIDO FORMULARIOS --- */
.card-contenido {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    padding: 40px;
    margin-bottom: 30px;
}

h2.titulo-seccion {
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 5px;
    border-left: 4px solid #1a4a9c;
    padding-left: 10px;
}

p.subtitulo-seccion {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 25px;
    margin-left: 14px;
}

/* Estilos de Inputs */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #444;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.2s;
    color: #333;
    background: #fcfcfc;
}

.form-input:focus {
    border-color: #1a4a9c;
    background: white;
    outline: none;
    box-shadow: 0 0 0 3px rgba(26, 74, 156, 0.1);
}

/* Botones */
.btn-guardar {
    background: #1a4a9c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-guardar:hover {
    background: #133a7a;
}

.btn-danger {
    background: #dc3545;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-danger:hover {
    background: #b02a37;
}

@media (max-width: 768px) {
    .layout-perfil {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="layout-perfil">

    <aside class="sidebar-perfil">
        <div class="nivel-badge">🏆 Nivel: Piloto Experto</div>

        <div class="avatar-container" style="margin-bottom: 15px;">
            <div
                style="width: 90px; height: 90px; background: #1a4a9c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto; border: 4px solid #f0f4ff;">
                {{ substr($user->name, 0, 2) }}
            </div>
        </div>

        <h3 style="margin: 10px 0 5px; font-weight: 700; color: #333;">{{ $user->name }}</h3>
        <p style="color: #777; font-size: 0.9rem;">{{ $user->email }}</p>

        <div class="puntos-rpm">
            Tienes <strong>1,250 RPM</strong> puntos<br>
            <small style="color: #888;">Canjeables por descuentos</small>
        </div>

        <nav class="menu-lateral" style="text-align: left; margin-top: 30px;">
            <a href="{{ route('perfil') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                🚗 Mi Garaje
            </a>
            <a href="{{ route('mis-citas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📅 Mis Citas
            </a>
            <a href="{{ route('mis-facturas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📄 Facturas
            </a>
            <a href="{{ route('configuracion') }}"
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; border-radius: 8px; transition: 0.2s;">
                ⚙️ Configuración
            </a>

            <div style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: #dc3545; padding: 12px; width: 100%; text-align: left; cursor: pointer; font-weight: 500; font-size: 1rem;">
                        🚪 Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main>

        <div class="card-contenido">
            <h2 class="titulo-seccion">Información Personal</h2>
            <p class="subtitulo-seccion">Actualiza tu nombre, teléfono y dirección de correo.</p>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label class="form-label" for="name">Nombre Completo</label>
                    <input class="form-input" id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                        required autofocus autocomplete="name">
                    @error('name') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Correo Electrónico</label>
                    <input class="form-input" id="email" name="email" type="email"
                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Teléfono de Contacto</label>
                    <input class="form-input" id="phone" name="phone" type="tel"
                        value="{{ old('phone', $user->phone ?? '') }}" placeholder="+34 600 000 000">
                    @error('phone') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div style="text-align: right; margin-top: 20px;">
                    @if (session('status') === 'profile-updated')
                    <span style="color: green; margin-right: 15px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check"></i> Guardado correctamente.
                    </span>
                    @endif
                    <button type="submit" class="btn-guardar">Guardar Cambios</button>
                </div>
            </form>
        </div>

        <div class="card-contenido">
            <h2 class="titulo-seccion">Seguridad</h2>
            <p class="subtitulo-seccion">Actualiza tu contraseña para mantener tu cuenta segura.</p>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="form-label" for="current_password">Contraseña Actual</label>
                    <input class="form-input" id="current_password" name="current_password" type="password"
                        autocomplete="current-password">
                    @error('current_password') <span style="color:red; font-size:0.85rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Nueva Contraseña</label>
                    <input class="form-input" id="password" name="password" type="password" autocomplete="new-password">
                    @error('password') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                    <input class="form-input" id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password">
                    @error('password_confirmation') <span style="color:red; font-size:0.85rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: right; margin-top: 20px;">
                    @if (session('status') === 'password-updated')
                    <span style="color: green; margin-right: 15px; font-size: 0.9rem;">
                        <i class="fa-solid fa-check"></i> Contraseña actualizada.
                    </span>
                    @endif
                    <button type="submit" class="btn-guardar">Actualizar Contraseña</button>
                </div>
            </form>
        </div>

        <div class="card-contenido" style="border: 1px solid #f8d7da; background: #fffdfd;">
            <h2 class="titulo-seccion" style="color: #dc3545; border-color: #dc3545;">Zona de Peligro</h2>
            <p class="subtitulo-seccion">Borrar tu cuenta es irreversible. Se eliminarán todos tus datos.</p>

            <form method="post" action="{{ route('profile.destroy') }}"
                onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta permanentemente?');">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label class="form-label" for="password_delete">Introduce tu contraseña para confirmar</label>
                    <input class="form-input" id="password_delete" name="password" type="password"
                        placeholder="Tu contraseña actual">
                    @error('password', 'userDeletion') <span style="color:red; font-size:0.85rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: right; margin-top: 20px;">
                    <button type="submit" class="btn-danger">Eliminar Cuenta</button>
                </div>
            </form>
        </div>

    </main>
</div>
@endsection