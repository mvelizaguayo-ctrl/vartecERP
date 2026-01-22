<x-filament-panels::page>
    <style>
        /* --- ESTILOS DE LAS TARJETAS --- */
        .fondo-gris { background-color: #f3f4f6; min-height: 100vh; padding: 2rem; }
        
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .grid-responsive { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
        
        .tarjeta { background-color: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-left: 4px solid; display: flex; align-items: center; justify-content: space-between; height: 140px; transition: box-shadow 0.3s; }
        .tarjeta:hover { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); cursor: pointer; }
        
        .texto-titulo { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: #6b7280; }
        .texto-grande { font-size: 1.875rem; font-weight: 700; color: #111827; margin-top: 0.25rem; }
        .texto-pequeno { font-size: 0.875rem; margin-top: 0.25rem; }
        
        .icono-circle { padding: 0.75rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; }
        .icono-svg { width: 2rem; height: 2rem; }

        /* COLORES */
        .borde-verde { border-color: #22c55e; }
        .texto-verde { color: #16a34a; }
        .fondo-verde { background-color: #dcfce7; }
        
        .borde-azul { border-color: #3b82f6; }
        .texto-azul { color: #2563eb; }
        .fondo-azul { background-color: #dbeafe; }

        .borde-rojo { border-color: #ef4444; }
        .texto-rojo { color: #dc2626; }
        .fondo-rojo { background-color: #fee2e2; }

        .borde-purple { border-color: #a855f7; }
        .texto-purple { color: #9333ea; }
        .fondo-purple { background-color: #f3e8ff; }

        .borde-amarillo { border-color: #eab308; }
        .texto-amarillo { color: #ca8a04; }
        .fondo-amarillo { background-color: #fef9c3; }

        .borde-gris { border-color: #4b5563; }
        .texto-gris { color: #4b5563; }
        .fondo-gris { 
            background-color: #f3f4f6; 
            min-height: 100vh; 
            width: 100vw; /* Fuerza ancho completo de ventana */
            padding: 1rem; /* Menos padding, más espacio para tarjetas */
        }

        .borde-indigo { border-color: #6366f1; }
        .texto-indigo { color: #4f46e5; }
        .fondo-indigo { background-color: #e0e7ff; }

        .borde-rose { border-color: #f43f5e; }
        .texto-rose { color: #e11d48; }
        .fondo-rose { background-color: #ffe4e6; }
        
        /* CONFIGURACIÓN */
        .tarjeta-plana { background-color: white; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: center; justify-content: center; height: 140px; cursor: pointer; transition: box-shadow 0.3s; }
        .tarjeta-plana:hover { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -1px rgba(0, 0, 0, 0.06); transform: translateY(-2px); }
        .contenido-plano { display: flex; align-items: center; justify-content: center; space-x: 0.75rem; color: #4b5563; }
        .font-bold-plano { font-weight: 700; }
        .espacio-x { margin-left: 0.75rem; }

        /* --- ATAQUE NUCLEAR AL MENÚ LATERAL --- */
        /* 1. Ocultar la barra lateral completa (Aside y Sidebar) */
        aside.fi-sidebar, 
        aside.filament-sidebar,
        .filament-sidebar-wrapper {
            display: none !important;
            width: 0 !important;
        }

        /* 2. Romper la Rejilla de Filament para que tenga 1 sola columna */
        .filament-panel-layout, 
        .filament-layout {
            grid-template-columns: 1fr !important; /* Esto mata la columna del menú */
        }

        /* 3. Eliminar el margen izquierdo del contenido principal (para que se expanda) */
        .filament-main, 
        .fi-main,
        .filament-main-content {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

                /* EXPANSIÓN A PANTALLA COMPLETA */
        .fi-main,
        .filament-main-content {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* ELIMINACIÓN DEFINITIVA DEL MENÚ (Si aún se ve) */
        .fi-sidebar,
        aside.fi-sidebar,
        .filament-sidebar {
            display: none !important;
            width: 0 !important;
            flex: 0 !important;
        }
        
        /* Ajuste de Grid para aprovechar espacio */
        .grid-3 { 
            width: 100%; 
            max-width: 1600px; /* Límite máximo para monitores gigantes, opcional */
            margin: 0 auto; /* Centra el contenido si el monitor es enorme */
        }
        
    </style>

    <div class="fondo-gris">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937;">Resumen de Operaciones</h2>
                <span style="font-size: 0.875rem; color: #6b7280;">VartecERP v1.0</span>
            </div>
            <!-- Espacio para botones futuros -->
        </div>

        <div class="grid-3">

            <!-- 1. VENTAS -->
            <div class="tarjeta borde-verde">
                <div>
                    <h3 class="texto-titulo">Ventas del Día</h3>
                    <p class="texto-grande">$ 0.00</p>
                    <p class="texto-pequeno texto-verde">0 Pedidos hoy</p>
                </div>
                <div class="icono-circle fondo-verde texto-verde">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <!-- 2. INVENTARIO -->
            <div class="tarjeta borde-azul">
                <div>
                    <h3 class="texto-titulo">Inventario</h3>
                    <p class="texto-grande">0</p>
                    <p class="texto-pequeno texto-azul">Productos bajo stock</p>
                </div>
                <div class="icono-circle fondo-azul texto-azul">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>

            <!-- 3. PROXY -->
            <div class="tarjeta borde-rojo">
                <div>
                    <h3 class="texto-titulo">Órdenes Proxy</h3>
                    <p class="texto-grande">PENDIENTE</p>
                    <p class="texto-pequeno texto-rojo">Sincronizar con .NET</p>
                </div>
                <div class="icono-circle fondo-rojo texto-rojo">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>

            <!-- 4. COMPRAS -->
            <div class="tarjeta borde-purple">
                <div>
                    <h3 class="texto-titulo">Compras</h3>
                    <p class="texto-grande">0</p>
                    <p class="texto-pequeno texto-purple">Pedidos a proveedores</p>
                </div>
                <div class="icono-circle fondo-purple texto-purple">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>

            <!-- 5. FACTURACIÓN -->
            <div class="tarjeta borde-amarillo">
                <div>
                    <h3 class="texto-titulo">Facturación</h3>
                    <p class="texto-grande">$ 0.00</p>
                    <p class="texto-pequeno texto-amarillo">Por cobrar</p>
                </div>
                <div class="icono-circle fondo-amarillo texto-amarillo">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>

            <!-- 6. REPORTES -->
            <div class="tarjeta borde-gris">
                <div>
                    <h3 class="texto-titulo">Reportes</h3>
                    <p class="texto-grande">Métricas</p>
                    <p class="texto-pequeno texto-gris">Ver análisis</p>
                </div>
                <div class="icono-circle fondo-gris-icono texto-gris">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>

            <!-- 7. TESORERÍA -->
            <div class="tarjeta borde-indigo">
                <div>
                    <h3 class="texto-titulo">Tesorería</h3>
                    <p class="texto-grande">$ 0.00</p>
                    <p class="texto-pequeno texto-indigo">Saldo Caja</p>
                </div>
                <div class="icono-circle fondo-indigo texto-indigo">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
            </div>

            <!-- 8. GASTOS -->
            <div class="tarjeta borde-rose">
                <div>
                    <h3 class="texto-titulo">Gastos</h3>
                    <p class="texto-grande">$ 0.00</p>
                    <p class="texto-pequeno texto-rose">Operativos</p>
                </div>
                <div class="icono-circle fondo-rose texto-rose">
                    <svg class="icono-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>

            <!-- 9. CONFIGURACIÓN -->
            <div class="tarjeta-plana">
                <div class="contenido-plano">
                    <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-bold-plano espacio-x">Configuración del Sistema</span>
                </div>
            </div>

        </div>
    </div>
</x-filament-panels::page>