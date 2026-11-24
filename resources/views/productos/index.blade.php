<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de productos — Gestión de Productos</title>

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

        .text-secondary {
            color: var(--texto-secundario) !important;
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

        .form-control:focus,
        .form-select:focus {
            border-color: var(--acento-terracota);
            box-shadow: 0 0 0 0.2rem rgba(200, 90, 50, 0.18);
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

        .btn-oliva {
            background-color: var(--acento-oliva);
            border-color: var(--acento-oliva);
            color: #ffffff;
            font-weight: 600;
            border-radius: 9px;
        }

        .btn-oliva:hover,
        .btn-oliva:focus {
            background-color: #325741;
            border-color: #325741;
            color: #ffffff;
        }

        .table thead th {
            background-color: #efe6da;
            color: var(--texto-principal);
            border-bottom-color: var(--borde-suave);
            font-weight: 600;
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            --bs-table-bg-type: #faf5ef;
        }

        .table-hover > tbody > tr:hover > * {
            --bs-table-bg-state: #f2e8dc;
        }

        .link-orden {
            color: var(--texto-principal);
            font-weight: 600;
        }

        .link-orden:hover {
            color: var(--acento-terracota);
        }

        /* Ajuste de paginación de Bootstrap 5 a la paleta cálida */
        .page-link {
            color: var(--texto-principal);
            border-color: var(--borde-suave);
            background-color: #ffffff;
        }

        .page-link:hover {
            color: var(--acento-terracota);
            background-color: #f6efe6;
            border-color: var(--borde-suave);
        }

        .page-item.active .page-link {
            background-color: var(--acento-terracota);
            border-color: var(--acento-terracota);
            color: #ffffff;
        }
    </style>
</head>
<body>
    <x-navbar-productos />

    <main class="container pb-5">
        <x-alertas />

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small rounded-3">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div>
                <h1 class="h3 fw-bold mb-1">Catálogo de productos</h1>
                <p class="text-secondary mb-0">Busca, filtra y ordena los productos.</p>
            </div>

            @if (auth()->user()?->rol === 'administrador')
                <a class="btn btn-oliva" href="{{ route('productos.create') }}">Registrar producto</a>
            @endif
        </div>

        <div class="card mb-4">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-3">Filtros</h2>

                <form action="{{ route('productos.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label" for="buscar">Nombre del producto</label>
                            <input
                                type="search"
                                id="buscar"
                                name="buscar"
                                class="form-control"
                                value="{{ old('buscar', $filtros['buscar'] ?? '') }}"
                                placeholder="Escribe un nombre"
                            >
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="categoria_id">Categoría</label>
                            <select class="form-select" id="categoria_id" name="categoria_id">
                                <option value="">Todas</option>
                                @foreach ($categorias as $categoria)
                                    <option
                                        value="{{ $categoria->id }}"
                                        @selected((string) old('categoria_id', $filtros['categoria_id'] ?? '') === (string) $categoria->id)
                                    >
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label" for="precio_min">Precio mín.</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="precio_min"
                                name="precio_min"
                                class="form-control"
                                value="{{ old('precio_min', $filtros['precio_min'] ?? '') }}"
                                placeholder="0.00"
                            >
                        </div>

                        <div class="col-md-2">
                            <label class="form-label" for="precio_max">Precio máx.</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="precio_max"
                                name="precio_max"
                                class="form-control"
                                value="{{ old('precio_max', $filtros['precio_max'] ?? '') }}"
                                placeholder="0.00"
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="">Todos</option>
                                <option
                                    value="Disponible"
                                    @selected(old('estado', $filtros['estado'] ?? '') === 'Disponible')
                                >
                                    Disponible
                                </option>
                                <option
                                    value="Agotado"
                                    @selected(old('estado', $filtros['estado'] ?? '') === 'Agotado')
                                >
                                    Agotado
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="por_pagina">Productos por página</label>
                            <select class="form-select" id="por_pagina" name="por_pagina">
                                @foreach ([10, 15, 25, 50] as $cantidad)
                                    <option
                                        value="{{ $cantidad }}"
                                        @selected((int) old('por_pagina', $filtros['por_pagina'] ?? 10) === $cantidad)
                                    >
                                        {{ $cantidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 d-flex flex-wrap gap-2">
                            <button class="btn btn-terracota" type="submit">Aplicar filtros</button>
                            <a class="btn btn-outline-secondary rounded-3" href="{{ route('productos.index') }}">
                                Limpiar filtros
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @php
            $urlOrden = function ($columna) use ($filtros, $orden, $direccion) {
                $siguiente = ($orden === $columna && $direccion === 'asc') ? 'desc' : 'asc';

                return route('productos.index', array_merge($filtros, [
                    'orden'     => $columna,
                    'direccion' => $siguiente,
                ]));
            };
        @endphp

        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>
                                <a class="text-decoration-none link-orden" href="{{ $urlOrden('nombre') }}">
                                    Nombre {{ $orden === 'nombre' ? ($direccion === 'asc' ? '↑' : '↓') : '' }}
                                </a>
                            </th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>
                                <a class="text-decoration-none link-orden" href="{{ $urlOrden('precio') }}">
                                    Precio {{ $orden === 'precio' ? ($direccion === 'asc' ? '↑' : '↓') : '' }}
                                </a>
                            </th>
                            <th>
                                <a class="text-decoration-none link-orden" href="{{ $urlOrden('existencias') }}">
                                    Existencias {{ $orden === 'existencias' ? ($direccion === 'asc' ? '↑' : '↓') : '' }}
                                </a>
                            </th>
                            <th>Estado</th>
                            <th>
                                <a class="text-decoration-none link-orden" href="{{ $urlOrden('fecha') }}">
                                    Fecha de registro {{ $orden === 'fecha' ? ($direccion === 'asc' ? '↑' : '↓') : '' }}
                                </a>
                            </th>
                            @if (auth()->user()?->rol === 'administrador')
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td class="fw-semibold">{{ $producto->nombre }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($producto->descripcion, 55) }}</td>
                                <td>{{ $producto->categoria->nombre }}</td>
                                <td>${{ number_format((float) $producto->precio, 2) }}</td>
                                <td>{{ $producto->existencias }}</td>
                                <td>
                                    <x-estado-producto :estado="$producto->estado" />
                                </td>
                                <td>{{ $producto->created_at?->format('d/m/Y H:i') }}</td>
                                @if (auth()->user()?->rol === 'administrador')
                                    <td class="text-nowrap">
                                        <a
                                            class="btn btn-sm btn-outline-dark rounded-2"
                                            href="{{ route('productos.edit', $producto) }}"
                                        >
                                            Editar
                                        </a>
                                        <form
                                            class="d-inline"
                                            action="{{ route('productos.destroy', $producto) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-outline-danger rounded-2"
                                                type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar este producto?')"
                                            >
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td
                                    class="text-center p-4 text-secondary"
                                    colspan="{{ auth()->user()?->rol === 'administrador' ? 9 : 8 }}"
                                >
                                    No se encontraron productos con esos filtros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
            <p class="text-secondary mb-0 small">
                Mostrando {{ $productos->firstItem() ?? 0 }} a {{ $productos->lastItem() ?? 0 }}
                de {{ $productos->total() }} productos. Página {{ $productos->currentPage() }} de {{ $productos->lastPage() }}.
            </p>

            {{ $productos->links('pagination::bootstrap-5') }}
        </div>
    </main>
</body>
</html>