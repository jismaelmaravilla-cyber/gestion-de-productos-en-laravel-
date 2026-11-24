<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $modo === 'crear' ? 'Registrar producto' : 'Editar producto' }} — Gestión de Productos</title>

    <!-- Tipografía: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg-arena: #f6f1eb;
            --superficie-tarjeta: #fffdf9;
            --texto-principal: #2b2118;
            --texto-secundario: #6e5d4f;
            --borde-suave: #e4d8ca;
            --acento-terracota: #c85a32;
            --acento-terracota-hover: #a84623;
            --acento-oliva: #3f6c51;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-arena);
            color: var(--texto-principal);
        }

        .card {
            background-color: var(--superficie-tarjeta);
            border: 1px solid var(--borde-suave);
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(43, 33, 24, 0.06);
        }

        .form-label {
            font-weight: 500;
            color: var(--texto-principal);
        }

        .form-control,
        .form-select {
            border-color: var(--borde-suave);
            background-color: #ffffff;
            color: var(--texto-principal);
            border-radius: 9px;
        }

        .form-control[readonly] {
            background-color: #f3ece2;
            color: var(--texto-secundario);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--acento-terracota);
            box-shadow: 0 0 0 0.2rem rgba(200, 90, 50, 0.18);
        }

        .form-text {
            color: var(--texto-secundario);
        }

        .btn-terracota {
            background-color: var(--acento-terracota);
            border-color: var(--acento-terracota);
            color: #ffffff;
            font-weight: 600;
            border-radius: 9px;
        }

        .btn-terracota:hover,
        .btn-terracota:focus {
            background-color: var(--acento-terracota-hover);
            border-color: var(--acento-terracota-hover);
            color: #ffffff;
        }
    </style>
</head>
<body>
    <x-navbar-productos />

    <main class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4 p-sm-5">
                        <h1 class="h3 fw-bold mb-4">
                            {{ $modo === 'crear' ? 'Registrar producto' : 'Editar producto' }}
                        </h1>

                        <x-alertas />

                        <form
                            action="{{ $modo === 'crear' ? route('productos.store') : route('productos.update', $producto) }}"
                            method="POST"
                        >
                            @csrf
                            @if ($modo === 'editar')
                                @method('PUT')
                            @endif

                            @php
                                $existenciasActuales = (int) old('existencias', $producto->existencias ?? 0);
                                $estadoCalculado = $existenciasActuales > 0 ? 'Disponible' : 'Agotado';
                            @endphp

                            {{-- Campo oculto para enviar 'estado' alineado con las reglas de GuardarProductoRequest --}}
                            <input type="hidden" name="estado" id="estado" value="{{ $estadoCalculado }}">

                            <div class="mb-3">
                                <label class="form-label" for="nombre">Nombre del producto</label>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    maxlength="255"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $producto->nombre) }}"
                                    required
                                >
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="descripcion">Descripción</label>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    rows="4"
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    required
                                >{{ old('descripcion', $producto->descripcion) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="categoria_id">Categoría</label>
                                    <select
                                        id="categoria_id"
                                        name="categoria_id"
                                        class="form-select @error('categoria_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="">Selecciona una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option
                                                value="{{ $categoria->id }}"
                                                @selected((string) old('categoria_id', $producto->categoria_id) === (string) $categoria->id)
                                            >
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="precio">Precio</label>
                                    <input
                                        type="number"
                                        id="precio"
                                        name="precio"
                                        min="0.01"
                                        step="0.01"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        value="{{ old('precio', $producto->precio) }}"
                                        required
                                    >
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="existencias">Existencias</label>
                                    <input
                                        type="number"
                                        id="existencias"
                                        name="existencias"
                                        min="0"
                                        step="1"
                                        class="form-control @error('existencias') is-invalid @enderror"
                                        value="{{ old('existencias', $producto->existencias ?? 0) }}"
                                        required
                                    >
                                    @error('existencias')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="estado_vista">Estado automático</label>
                                    <input
                                        type="text"
                                        id="estado_vista"
                                        class="form-control"
                                        value="{{ $estadoCalculado }}"
                                        readonly
                                    >
                                    <div class="form-text">Se determina a partir de las existencias.</div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <button class="btn btn-terracota" type="submit">
                                    {{ $modo === 'crear' ? 'Guardar producto' : 'Guardar cambios' }}
                                </button>
                                <a class="btn btn-outline-secondary rounded-3" href="{{ route('productos.index') }}">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const inputExistencias = document.getElementById('existencias');
        const inputEstadoVista = document.getElementById('estado_vista');
        const inputEstadoHidden = document.getElementById('estado');

        if (inputExistencias && inputEstadoVista && inputEstadoHidden) {
            inputExistencias.addEventListener('input', function () {
                const cantidad = parseInt(this.value, 10);
                const nuevoEstado = (!isNaN(cantidad) && cantidad > 0) ? 'Disponible' : 'Agotado';
                inputEstadoVista.value = nuevoEstado;
                inputEstadoHidden.value = nuevoEstado;
            });
        }
    </script>
</body>
</html>