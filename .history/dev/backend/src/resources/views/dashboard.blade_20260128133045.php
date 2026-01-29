<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dashboard-racing.css') }}">
    
    <div class="racing-body">
        
        <div class="dashboard-container">
            
            <div class="dash-header">
                <div>
                    <h2 class="racing-title" style="text-align: left; margin:0; font-size:1.2rem;">Centro de Comando</h2>
                    <p style="color: var(--color-contraste); font-size:0.9rem;">Piloto: {{ Auth::user()->name }}</p>
                </div>
                <div style="display:flex; align-items:center; gap:10px; background: rgba(46, 144, 255, 0.1); padding: 5px 15px; border-radius: 20px; border: 1px solid var(--color-acento);">
                    <span style="color: var(--color-acento); font-weight:bold; font-size:0.8rem;">SISTEMAS ONLINE</span>
                    <div style="width:8px; height:8px; background:var(--color-acento); border-radius:50%; box-shadow: 0 0 10px var(--color-acento);"></div>
                </div>
            </div>

            <div class="widget widget-large">
                <span class="widget-header">Estado General</span>
                <p style="font-size: 1.1rem; line-height: 1.6;">
                    Hola, <span class="text-acento" style="font-weight:bold;">{{ Auth::user()->name }}</span>. 
                    Bienvenido de nuevo a 404 RPM. Tu garaje está sincronizado.
                </p>
                <div style="margin-top: 25px; display: flex; gap: 40px;">
                    <div>
                        <span class="widget-header" style="display:block; margin-bottom:5px;">Citas Activas</span>
                        <p class="widget-value text-acento">0</p>
                    </div>
                    <div>
                        <span class="widget-header" style="display:block; margin-bottom:5px;">Vehículos</span>
                        <p class="widget-value">1</p>
                    </div>
                </div>
            </div>

            <div class="widget" style="text-align: center;">
                <span class="widget-header" style="color: var(--color-secundario);">Completado</span>
                
                <div class="gauge-circle">
                    <div class="gauge-inner">
                        75%
                    </div>
                </div>
                
                <p style="margin-top: 15px; font-size: 0.8rem; color: #888;">Perfil de Usuario</p>
            </div>

            <div class="widget">
                <span class="widget-header">Actividad Reciente</span>
                <div style="display: flex; align-items: baseline; gap: 5px;">
                    <span class="widget-value">24</span>
                    <span style="font-size: 0.8rem; color: #666;">HORAS</span>
                </div>
                <div class="progress-bg">
                    <div class="progress-fill fill-blue" style="width: 80%;"></div>
                </div>
                <p style="margin-top: 10px; font-size: 0.8rem; color: #888;">Tiempo desde última visita</p>
            </div>

            <div class="widget" style="border-top: 2px solid var(--color-secundario);">
                <span class="widget-header" style="color: var(--color-secundario);">Notificaciones</span>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 5px;">
                    <span class="widget-value text-secundario">3</span>
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; color: var(--color-secundario);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <p style="font-size: 0.8rem; color: #aaa; margin-top: 5px;">Ofertas y Mantenimiento</p>
            </div>

            <div class="widget" style="cursor: pointer; transition: 0.3s; border: 1px dashed rgba(255,255,255,0.2);">
                <span class="widget-header">Ajustes</span>
                <div style="margin-top: auto; display:flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.9rem; color: #888;">Editar Perfil</span>
                    <span style="color: var(--color-acento); font-weight: bold;">></span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>