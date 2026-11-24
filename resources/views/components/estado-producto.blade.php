@props(['estado' => 'Agotado'])

@php
    $esDisponible = $estado === 'Disponible';
@endphp

<span
    class="badge rounded-pill px-3 py-2 fw-semibold"
    style="
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        font-size: 0.78rem;
        background-color: {{ $esDisponible ? '#e6f0ea' : '#efe6da' }};
        color: {{ $esDisponible ? '#244733' : '#6e5d4f' }};
        border: 1px solid {{ $esDisponible ? '#b5d1c0' : '#d8c8b6' }};
    "
>
    {{ $estado }}
</span>