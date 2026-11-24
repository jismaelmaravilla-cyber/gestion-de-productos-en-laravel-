<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarProductoRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return $this->user()?->rol === 'administrador';
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $producto = $this->route('producto');

        $nombreUnico = Rule::unique('productos', 'nombre');

        if ($producto) {
            $nombreUnico->ignore($producto);
        }

        return [
            'nombre'       => ['required', 'string', 'max:255', $nombreUnico],
            'descripcion'  => ['required', 'string', 'max:5000'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'precio'       => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'existencias'  => ['required', 'integer', 'min:0', 'max:2147483647'],
            'estado'       => ['required', 'string', Rule::in(['Disponible', 'Agotado'])],
        ];
    }

    /**
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required'       => 'Escribe el nombre del producto.',
            'nombre.unique'         => 'Ya existe un producto con ese nombre.',
            'descripcion.required'  => 'Escribe una descripción.',
            'categoria_id.required' => 'Selecciona una categoría.',
            'categoria_id.exists'   => 'Selecciona una categoría válida del catálogo.',
            'precio.required'       => 'Escribe el precio del producto.',
            'precio.numeric'        => 'El precio debe ser un número.',
            'precio.gt'             => 'El precio debe ser mayor que cero.',
            'existencias.required'  => 'Escribe el número de existencias.',
            'existencias.integer'   => 'Las existencias deben ser un número entero.',
            'existencias.min'       => 'Las existencias no pueden ser negativas.',
            'estado.required'       => 'Selecciona el estado del producto.',
            'estado.in'             => 'El estado debe ser Disponible o Agotado.',
        ];
    }
}
