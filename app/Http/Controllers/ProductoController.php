<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltrarProductosRequest;
use App\Http\Requests\GuardarProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(Request $request): View
    {
        $filtros = $request->all();
        $consulta = Producto::query()->with('categoria');

        if (!empty($filtros['buscar'])) {
            $texto = mb_strtolower(trim((string) $filtros['buscar']));
            $consulta->whereRaw('LOWER(nombre) LIKE ?', ["%{$texto}%"]);
        }

        if (!empty($filtros['categoria_id'])) {
            $consulta->where('categoria_id', $filtros['categoria_id']);
        }

        if (isset($filtros['precio_min']) && $filtros['precio_min'] !== '') {
            $consulta->where('precio', '>=', $filtros['precio_min']);
        }

        if (isset($filtros['precio_max']) && $filtros['precio_max'] !== '') {
            $consulta->where('precio', '<=', $filtros['precio_max']);
        }

        if (!empty($filtros['estado'])) {
            if ($filtros['estado'] === 'Disponible') {
                $consulta->where('existencias', '>', 0);
            } else {
                $consulta->where('existencias', '=', 0);
            }
        }

        $columnas = [
            'nombre'      => 'nombre',
            'precio'      => 'precio',
            'existencias' => 'existencias',
            'fecha'       => 'created_at',
        ];

        $orden = $filtros['orden'] ?? 'fecha';
        if (!array_key_exists($orden, $columnas)) {
            $orden = 'fecha';
        }

        $direccion = strtolower((string) ($filtros['direccion'] ?? 'desc'));
        if (!in_array($direccion, ['asc', 'desc'], true)) {
            $direccion = 'desc';
        }

        $porPagina = (int) ($filtros['por_pagina'] ?? 10);
        if (!in_array($porPagina, [10, 15, 25, 50], true)) {
            $porPagina = 10;
        }

        $productos = $consulta
            ->orderBy($columnas[$orden], $direccion)
            ->orderBy('id') 
            ->paginate($porPagina)
            ->withQueryString();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.index', compact(
            'productos',
            'categorias',
            'filtros',
            'orden',
            'direccion'
        ));
    }


    public function create(): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.formulario', [
            'producto'   => new Producto(),
            'categorias' => $categorias,
            'modo'       => 'crear',
        ]);
    }

   
    public function store(GuardarProductoRequest $request): RedirectResponse
    {
        Producto::create($request->validated());

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto registrado correctamente.');
    }

    
    public function edit(Producto $producto): View
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('productos.formulario', compact('producto', 'categorias') + ['modo' => 'editar']);
    }

   
    public function update(GuardarProductoRequest $request, Producto $producto): RedirectResponse
    {
        $producto->update($request->validated());

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto actualizado correctamente.');
    }

  
    public function destroy(Producto $producto): RedirectResponse
    {
        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto eliminado.');
    }
}