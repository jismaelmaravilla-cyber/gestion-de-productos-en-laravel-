<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — Gestión de Productos</title>

    <!-- Tipografía moderna y limpia: Plus Jakarta Sans -->
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
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-arena);
            color: var(--texto-principal);
        }

        .tarjeta-login {
            width: 100%;
            max-width: 410px;
            background-color: var(--superficie-tarjeta);
            border: 1px solid var(--borde-suave);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(43, 33, 24, 0.08);
        }

        .form-label {
            font-weight: 500;
            color: var(--texto-principal);
        }

        .form-control {
            border-color: var(--borde-suave);
            background-color: #ffffff;
            color: var(--texto-principal);
            border-radius: 10px;
            padding: 0.6rem 0.85rem;
        }

        .form-control:focus {
            border-color: var(--acento-terracota);
            box-shadow: 0 0 0 0.2rem rgba(200, 90, 50, 0.2);
        }

        .btn-terracota {
            background-color: var(--acento-terracota);
            border-color: var(--acento-terracota);
            color: #ffffff;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.65rem 1rem;
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
    <div class="container d-flex justify-content-center align-items-center min-vh-100 px-3">
        <div class="card tarjeta-login border-0">
            <div class="card-body p-4 p-sm-5">
                <p class="text-uppercase small fw-semibold mb-1" style="color: var(--acento-terracota); letter-spacing: 0.06em;">
                    Sistema de Productos
                </p>
                <h2 class="fw-bold mb-4">Iniciar sesión</h2>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.procesar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="email">Correo electrónico</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password">Contraseña</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-terracota w-100">
                        Iniciar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>