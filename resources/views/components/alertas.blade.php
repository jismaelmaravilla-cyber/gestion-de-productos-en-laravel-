@if (session('ok'))
    <div
        class="alert py-2 px-3 rounded-3 mb-3"
        role="alert"
        style="background-color: #e6f0ea; border: 1px solid #b5d1c0; color: #244733; font-family: 'Plus Jakarta Sans', system-ui, sans-serif;"
    >
        {{ session('ok') }}
    </div>
@endif

@if ($errors->any())
    <div
        class="alert py-2 px-3 rounded-3 mb-3"
        role="alert"
        style="background-color: #fbeae5; border: 1px solid #ebc0b3; color: #7c2d12; font-family: 'Plus Jakarta Sans', system-ui, sans-serif;"
    >
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif