<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FiltrarProductosRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return in_array($this->user()?->rol, ['administrador', 'empleado'], true);
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buscar'       => ['nullable', 'string', 'max:100'],
            'categoria_id' => ['nullable', 'integer', 'exists:categorias,id'],
            'precio_min'   => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'precio_max'   => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'estado'       => ['nullable', 'in:Disponible,Agotado'],
            'orden'        => ['nullable', 'in:nombre,precio,existencias,fecha'],
            'direccion'    => ['nullable', 'in:asc,desc'],
            'por_pagina'   => ['nullable', 'in:10,15,25,50'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $minimo = $this->input('precio_min');
                $maximo = $this->input('precio_max');

                if (
                    $minimo !== null && $minimo !== '' &&
                    $maximo !== null && $maximo !== '' &&
                    (float) $minimo > (float) $maximo
                ) {
                    $validator->errors()->add(
                        'precio_min',
                        'El precio mínimo no puede ser mayor que el precio máximo.'
                    );
                }
            },
        ];
    }

    /**
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
        ];
    }
}
