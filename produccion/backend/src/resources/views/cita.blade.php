@extends('layouts.layout')

@section('title', 'Pedir Cita | 404 RPM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
@endpush

@section('content')

<div class="banner-hero-cita">
    <div class="banner-contenido">
        <h1>Agenda tu Cita</h1>
        <p>Expertos en mecánica y performance listos para tu coche</p>
    </div>
</div>

<div class="contenedor-formulario-main">

    <form action="{{ route('citas.store') }}" method="POST" class="form-cita">
        @csrf

        <div class="cabecera-form">
            <h2>Datos de la Reserva</h2>
            <p>Rellena el formulario y confirmaremos tu cita al instante.</p>
        </div>

        <fieldset class="grupo-form">
            <legend>Datos del Conductor</legend>
            <div class="form-row">
                <div class="input-box">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                        class="{{ Auth::check() ? 'input-readonly' : '' }}" {{ Auth::check() ? 'readonly' : '' }}
                        required>
                </div>
                <div class="input-box">
                    <label>Teléfono</label>
                    <input type="tel" name="phone" value="{{ Auth::check() ? Auth::user()->phone : old('phone') }}"
                        placeholder="+34 600 000 000" required>
                </div>
            </div>
            <div class="input-box full-width">
                <label>Correo Electrónico</label>
                <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                    class="{{ Auth::check() ? 'input-readonly' : '' }}" {{ Auth::check() ? 'readonly' : '' }} required>
            </div>
        </fieldset>

        <fieldset class="grupo-form">
            <legend>Vehículo</legend>
            @if(Auth::check() && $misCoches->count() > 0)
            <div id="selector-coche-wrapper">
                <div class="input-box full-width">
                    <label>Selecciona de tu garaje</label>
                    <select name="car_id" id="select-coche">
                        @foreach($misCoches as $coche)
                        <option value="{{ $coche->id }}">
                            {{ $coche->brand->name }} {{ $coche->model }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-top: 15px;">
                    <label class="toggle-manual"
                        style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" id="check-manual" onchange="toggleManualInput()"
                            style="width: auto; margin: 0;">
                        <span>No encuentro mi coche / Traeré otro vehículo</span>
                    </label>
                </div>
            </div>
            <div id="manual-coche-wrapper"
                style="display: none; margin-top: 15px; border-top: 1px dashed #e2e8f0; padding-top: 15px;">
                <div class="form-row">
                    <div class="input-box">
                        <label>Marca</label>
                        <input type="text" name="brand_manual" placeholder="Ej: Audi">
                    </div>
                    <div class="input-box">
                        <label>Modelo</label>
                        <input type="text" name="model_manual" placeholder="Ej: A3">
                    </div>
                </div>
            </div>
            @else
            <div class="form-row">
                <div class="input-box">
                    <label>Marca</label>
                    <input type="text" name="brand_manual" placeholder="Ej: BMW" required>
                </div>
                <div class="input-box">
                    <label>Modelo</label>
                    <input type="text" name="model_manual" placeholder="Ej: Serie 1" required>
                </div>
            </div>
            @endif
        </fieldset>

        <fieldset class="grupo-form" style="margin-bottom: 0;">
            <legend>Detalles del Servicio</legend>
            <div class="form-row">
                <div class="input-box">
                    <label>Fecha Preferente</label>
                    <input type="date" name="fecha" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="input-box">
                    <label>Hora Aproximada</label>
                    <select name="hora">
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                    </select>
                </div>
            </div>
            <div class="input-box full-width">
                <label>Descripción del problema / Notas</label>
                <textarea name="description" placeholder="Descríbenos qué le pasa al coche..."></textarea>
            </div>
        </fieldset>

        <button type="submit" class="btn-submit">Confirmar Cita 🏁</button>
    </form>
</div>

<script>
function toggleManualInput() {
    const check = document.getElementById('check-manual');
    const manualDiv = document.getElementById('manual-coche-wrapper');
    const select = document.getElementById('select-coche');
    if (check && check.checked) {
        manualDiv.style.display = 'block';
        if (select) select.disabled = true;
    } else {
        manualDiv.style.display = 'none';
        if (select) select.disabled = false;
    }
}
</script>
@endsection