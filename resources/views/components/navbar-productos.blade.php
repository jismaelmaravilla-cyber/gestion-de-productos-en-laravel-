<nav
    class="navbar navbar-expand-lg mb-4"
    style="
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background-color: #2b2118;
        border-bottom: 3px solid #c85a32;
    "
>
    <div class="container">
        <a
            class="navbar-brand fw-bold text-white"
            href="{{ route('productos.index') }}"
        >
            Catálogo de productos
        </a>

        <div class="d-flex flex-wrap align-items-center gap-3 text-white">
            @auth
                <span class="small" style="color: #f6f1eb;">
                    {{ auth()->user()->name }}
                    <span
                        class="badge ms-1 text-uppercase"
                        style="background-color: #c85a32; color: #ffffff; font-size: 0.7rem;"
                    >
                        {{ auth()->user()->rol }}
                    </span>
                </span>

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button
                        class="btn btn-sm rounded-3 px-3"
                        type="submit"
                        style="border: 1px solid #e4d8ca; color: #fffdf9; background-color: transparent;"
                    >
                        Cerrar sesión
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>